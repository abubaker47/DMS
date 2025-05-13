<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use App\Models\FileType;
use App\Models\Department;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('documents.index');
        }

        $documentCount = Document::count();
        $userCount = User::count();
        $departmentCount = Department::count();
        $fileTypeCount = FileType::count();

        // For charts: documents per department (sent and received), documents per file type
        $documentsFromDepartment = Department::withCount('sentDocuments')->get()->pluck('sent_documents_count', 'name');
        $documentsToDepartment = Department::withCount('receivedDocuments')->get()->pluck('received_documents_count', 'name');
        $documentsPerFileType = FileType::withCount('documents')->get()->pluck('documents_count', 'name');

        // Get recent activities
        $recentActivities = Activity::with(['user', 'document'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', [
            'documentCount' => $documentCount,
            'userCount' => $userCount,
            'departmentCount' => $departmentCount,
            'fileTypeCount' => $fileTypeCount,
            'documentsFromDepartment' => $documentsFromDepartment,
            'documentsToDepartment' => $documentsToDepartment,
            'documentsPerFileType' => $documentsPerFileType,
            'recentActivities' => $recentActivities,
        ]);
    }
}
