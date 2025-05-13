<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of unseen documents.
     */
    public function index()
    {
        $user = Auth::user();
        $documents = Document::with(['fromDepartment', 'creator', 'fileType'])
            ->where('to_department_id', $user->department_id)
            ->whereNull('viewed_at')
            ->latest()
            ->paginate(10);

        return view('notifications.index', compact('documents'));
    }

    /**
     * Get recent unseen documents for the notification dropdown.
     */
    public function getUnseenDocuments()
    {
        $user = Auth::user();
        $documents = Document::with(['fromDepartment', 'creator', 'fileType'])
            ->where('to_department_id', $user->department_id)
            ->whereNull('viewed_at')
            ->latest()
            ->take(5)
            ->get();

        $count = Document::where('to_department_id', $user->department_id)
            ->whereNull('viewed_at')
            ->count();

        return response()->json([
            'documents' => $documents,
            'count' => $count
        ]);
    }
}
