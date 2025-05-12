<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\Department;
use App\Models\FileType;

class DashboardController extends Controller
{
    public function index()
    {
        $this->authorize('isAdmin');

        $documentCount = Document::count();
        $userCount = User::count();
        $departmentCount = Department::count();
        $fileTypeCount = FileType::count();

        // For charts: documents per department, documents per file type
        $documentsPerDepartment = Department::withCount('sentDocuments')->get()->pluck('sent_documents_count', 'name');
        $documentsPerFileType = FileType::withCount('documents')->get()->pluck('documents_count', 'name');

        return view('dashboard', [
            'documentCount' => $documentCount,
            'userCount' => $userCount,
            'departmentCount' => $departmentCount,
            'fileTypeCount' => $fileTypeCount,
            'documentsPerDepartment' => $documentsPerDepartment,
            'documentsPerFileType' => $documentsPerFileType,
        ]);
    }
}
