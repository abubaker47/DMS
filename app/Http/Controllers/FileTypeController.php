<?php

namespace App\Http\Controllers;

use App\Models\FileType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FileTypeController extends Controller
{
    /**
     * Display a listing of the file types.
     */
    public function index()
    {
        $this->authorize('viewAny', FileType::class);
        
        $fileTypes = FileType::all();
        
        return view('file-types.index', compact('fileTypes'));
    }

    /**
     * Show the form for creating a new file type.
     */
    public function create()
    {
        $this->authorize('create', FileType::class);
        
        return view('file-types.create');
    }

    /**
     * Store a newly created file type in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', FileType::class);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:file_types',
            'name_dari' => 'nullable|string|max:255',
            'name_pashto' => 'nullable|string|max:255',
            'extension' => 'required|string|max:10',
            'mime_type' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);
        
        FileType::create($validated);
        
        return redirect()->route('file-types.index')
            ->with('success', __('File type created successfully'));
    }

    /**
     * Display the specified file type.
     */
    public function show(FileType $fileType)
    {
        $this->authorize('view', $fileType);
        
        return view('file-types.show', compact('fileType'));
    }

    /**
     * Show the form for editing the specified file type.
     */
    public function edit(FileType $fileType)
    {
        $this->authorize('update', $fileType);
        
        return view('file-types.edit', compact('fileType'));
    }

    /**
     * Update the specified file type in storage.
     */
    public function update(Request $request, FileType $fileType)
    {
        $this->authorize('update', $fileType);
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('file_types')->ignore($fileType->id)],
            'name_dari' => 'nullable|string|max:255',
            'name_pashto' => 'nullable|string|max:255',
            'extension' => 'required|string|max:10',
            'mime_type' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);
        
        $fileType->update($validated);
        
        return redirect()->route('file-types.index')
            ->with('success', __('File type updated successfully'));
    }

    /**
     * Remove the specified file type from storage.
     */
    public function destroy(FileType $fileType)
    {
        $this->authorize('delete', $fileType);
        
        // Check if file type has documents
        if ($fileType->documents()->count() > 0) {
            return redirect()->route('file-types.index')
                ->with('error', __('Cannot delete file type with associated documents'));
        }
        
        $fileType->delete();
        
        return redirect()->route('file-types.index')
            ->with('success', __('File type deleted successfully'));
    }
}
