<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Document;
use App\Models\DocumentHistory;
use App\Models\FileType;
use App\Models\User;
use App\Notifications\DocumentAssigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Display a listing of the documents.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $departmentId = $user->department_id;
        $type = $request->get('type', 'sent');

        $query = Document::with(['fromDepartment', 'toDepartment', 'creator', 'fileType']);

        if ($user->isAdmin()) {
            // Admin can see all documents but still filtered by sent/received
            if ($type === 'sent') {
                $query->where('from_department_id', $departmentId);
            } else {
                $query->where('to_department_id', $departmentId);
            }
        } else {
            // Regular users documents filtered by sent/received
            if ($type === 'sent') {
                $query->where('from_department_id', $departmentId);
            } else {
                $query->where('to_department_id', $departmentId);
            }
        }

        $documents = $query->latest()->paginate(10);

        return view('documents.index', compact('documents', 'type'));
    }

    /**
     * Show the form for creating a new document.
     */
    public function create()
    {
        $this->authorize('create', Document::class);

        $departments = Department::where('is_active', true)->get();
        $fileTypes = FileType::where('is_active', true)->get();

        return view('documents.create', compact('departments', 'fileTypes'));
    }

    /**
     * Store a newly created document in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Document::class);

        $validated = $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'file_type_id' => 'required|exists:file_types,id',
            'to_department_id' => 'required|exists:departments,id',
            'description' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',
        ]);

        $user = Auth::user();
        $file = $request->file('file');
        $originalFileName = $file->getClientOriginalName();
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

        // Check if encryption is enabled
        $isEncrypted = $request->has('encrypt_file');
        $encryptionKey = null;
        $encryptionIv = null;

        if ($isEncrypted) {
            // Generate encryption key and IV
            $encryptionKey = Str::random(32);
            $encryptionIv = Str::random(16);

            // Encrypt file content
            $fileContent = file_get_contents($file->getRealPath());
            $encryptedContent = openssl_encrypt(
                $fileContent,
                'AES-256-CBC',
                $encryptionKey,
                0,
                $encryptionIv
            );

            // Store encrypted content
            Storage::put('documents/' . $fileName, $encryptedContent);
        } else {
            // Store file normally
            $file->storeAs('documents', $fileName);
        }

        // Create document record
        $document = Document::create([
            'file_name' => $fileName,
            'original_file_name' => $originalFileName,
            'file_path' => 'documents/' . $fileName,
            'file_type_id' => $validated['file_type_id'],
            'from_department_id' => $user->department_id,
            'to_department_id' => $validated['to_department_id'],
            'created_by' => $user->id,
            'description' => $validated['description'] ?? null,
            'description_dari' => $validated['description_dari'] ?? null,
            'description_pashto' => $validated['description_pashto'] ?? null,
            'status' => 'pending',
            'assigned_at' => now(),
            'is_encrypted' => $isEncrypted,
            'encryption_key' => $encryptionKey ? Crypt::encryptString($encryptionKey) : null,
            'encryption_iv' => $encryptionIv ? Crypt::encryptString($encryptionIv) : null,
        ]);

        // Create document history
        DocumentHistory::create([
            'document_id' => $document->id,
            'user_id' => $user->id,
            'action' => 'created',
            'notes' => 'Document created and assigned to ' . $document->toDepartment->name,
        ]);

        // Notify users in the receiving department
        $recipientUsers = User::where('department_id', $validated['to_department_id'])
            ->where('is_active', true)
            ->get();

        foreach ($recipientUsers as $recipient) {
            $recipient->notify(new DocumentAssigned($document));
        }

        return redirect()->route('documents.index')
            ->with('success', __('Document created and assigned successfully'));
    }

    /**
     * Display the specified document.
     */
    public function show(Request $request, Document $document)
    {
        $this->authorize('view', $document);

        $user = Auth::user();

        // If the document hasn't been viewed yet and the user is from the receiving department
        if (!$document->viewed_at && $user->department_id === $document->to_department_id) {
            $document->update(['viewed_at' => now(), 'status' => 'received']);

            // Create document history
            DocumentHistory::create([
                'document_id' => $document->id,
                'user_id' => $user->id,
                'action' => 'viewed',
                'notes' => 'Document viewed by ' . $user->name,
            ]);
        }

        $histories = $document->histories()->with('user')->latest()->get();

        // Check if this is an AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            // Load relationships for JSON response
            $document->load(['fileType', 'fromDepartment', 'toDepartment', 'creator']);

            return response()->json([
                'document' => $document,
                'histories' => $histories,
                'can_download' => $user->can('download', $document),
                'can_update_status' => $user->can('updateStatus', $document),
            ]);
        }

        // For regular requests, just redirect to the index page
        return redirect()->route('documents.index');
    }

    /**
     * Download the specified document.
     */
    public function download(Document $document)
    {
        $this->authorize('download', $document);

        // Create document history
        DocumentHistory::create([
            'document_id' => $document->id,
            'user_id' => Auth::id(),
            'action' => 'downloaded',
            'notes' => 'Document downloaded by ' . Auth::user()->name,
        ]);

        if ($document->is_encrypted) {
            // Decrypt the file
            $encryptionKey = Crypt::decryptString($document->encryption_key);
            $encryptionIv = Crypt::decryptString($document->encryption_iv);

            $encryptedContent = Storage::get($document->file_path);
            $decryptedContent = openssl_decrypt(
                $encryptedContent,
                'AES-256-CBC',
                $encryptionKey,
                0,
                $encryptionIv
            );

            return response($decryptedContent)
                ->header('Content-Type', $document->fileType->mime_type)
                ->header('Content-Disposition', 'attachment; filename="' . $document->original_file_name . '"');
        }

        return Storage::download($document->file_path, $document->original_file_name);
    }

    /**
     * Update the document status.
     */
    public function updateStatus(Request $request, Document $document)
    {
        $this->authorize('updateStatus', $document);

        $validated = $request->validate([
            'status' => 'required|in:pending,received,completed,rejected',
            'notes' => 'nullable|string',
        ]);

        $user = Auth::user();
        $oldStatus = $document->status;
        $newStatus = $validated['status'];

        $document->status = $newStatus;

        if ($newStatus === 'completed') {
            $document->completed_at = now();
        }

        $document->save();

        // Create document history
        DocumentHistory::create([
            'document_id' => $document->id,
            'user_id' => $user->id,
            'action' => 'status_updated',
            'notes' => $validated['notes'] ?? "Status changed from {$oldStatus} to {$newStatus}",
        ]);

        return redirect()->route('documents.show', $document)
            ->with('success', __('Document status updated successfully'));
    }

    /**
     * Preview the specified document.
     */
    public function preview(Document $document)
    {
        $this->authorize('view', $document);

        // Create document history
        DocumentHistory::create([
            'document_id' => $document->id,
            'user_id' => Auth::id(),
            'action' => 'previewed',
            'notes' => 'Document previewed by ' . Auth::user()->name,
        ]);

        if ($document->is_encrypted) {
            // Decrypt the file
            $encryptionKey = Crypt::decryptString($document->encryption_key);
            $encryptionIv = Crypt::decryptString($document->encryption_iv);

            $encryptedContent = Storage::get($document->file_path);
            $decryptedContent = openssl_decrypt(
                $encryptedContent,
                'AES-256-CBC',
                $encryptionKey,
                0,
                $encryptionIv
            );

            return response($decryptedContent)
                ->header('Content-Type', $document->fileType->mime_type)
                ->header('Content-Disposition', 'inline; filename="' . $document->original_file_name . '"');
        }

        // For non-encrypted files, use Storage::response which sets the correct headers for inline display
        return Storage::response($document->file_path, $document->original_file_name, [
            'Content-Type' => $document->fileType->mime_type,
            'Content-Disposition' => 'inline; filename="' . $document->original_file_name . '"'
        ]);
    }

    /**
     * Remove the specified document from storage.
     */
    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);

        // Delete the file from storage
        if (Storage::exists($document->file_path)) {
            Storage::delete($document->file_path);
        }

        // Delete document histories
        $document->histories()->delete();

        // Delete the document record
        $document->delete();

        return response()->json([
            'success' => true,
            'message' => __('Document deleted successfully')
        ]);
    }
}
