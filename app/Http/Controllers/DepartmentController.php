<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the departments.
     */
    public function index()
    {
        $this->authorize('viewAny', Department::class);

        $departments = Department::all();

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new department.
     */
    public function create()
    {
        $this->authorize('create', Department::class);

        return view('departments.create');
    }

    /**
     * Store a newly created department in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Department::class);

        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_dari' => 'required|string|max:255',
            'name_pashto' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Map the form field names to the database field names
        $departmentData = [
            'name' => $validated['name_en'],
            'name_dari' => $validated['name_dari'],
            'name_pashto' => $validated['name_pashto'],
            'description' => $validated['description_en'] ?? null,
            'description_dari' => $validated['description_dari'] ?? null,
            'description_pashto' => $validated['description_pashto'] ?? null,
            'is_active' => $validated['is_active'] ?? false,
        ];

        Department::create($departmentData);

        return redirect()->route('departments.index')
            ->with('success', __('Department created successfully'));
    }

    /**
     * Display the specified department.
     */
    public function show(Department $department)
    {
        $this->authorize('view', $department);

        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified department.
     */
    public function edit(Department $department)
    {
        $this->authorize('update', $department);

        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified department in storage.
     */
    public function update(Request $request, Department $department)
    {
        $this->authorize('update', $department);

        $validated = $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_dari' => 'required|string|max:255',
            'name_pashto' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Map the form field names to the database field names
        $departmentData = [
            'name' => $validated['name_en'],
            'name_dari' => $validated['name_dari'],
            'name_pashto' => $validated['name_pashto'],
            'description' => $validated['description_en'] ?? null,
            'description_dari' => $validated['description_dari'] ?? null,
            'description_pashto' => $validated['description_pashto'] ?? null,
            'is_active' => $validated['is_active'] ?? false,
        ];

        $department->update($departmentData);

        return redirect()->route('departments.index')
            ->with('success', __('Department updated successfully'));
    }

    /**
     * Remove the specified department from storage.
     */
    public function destroy(Department $department)
    {
        $this->authorize('delete', $department);

        // Check if department has users
        if ($department->users()->count() > 0) {
            return redirect()->route('departments.index')
                ->with('error', __('Cannot delete department with assigned users'));
        }

        // Check if department has documents
        if ($department->sentDocuments()->count() > 0 || $department->receivedDocuments()->count() > 0) {
            return redirect()->route('departments.index')
                ->with('error', __('Cannot delete department with associated documents'));
        }

        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', __('Department deleted successfully'));
    }
}
