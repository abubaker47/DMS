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
            'name' => 'required|string|max:255|unique:departments',
            'name_dari' => 'nullable|string|max:255',
            'name_pashto' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        
        Department::create($validated);
        
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
            'name' => ['required', 'string', 'max:255', Rule::unique('departments')->ignore($department->id)],
            'name_dari' => 'nullable|string|max:255',
            'name_pashto' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        
        $department->update($validated);
        
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
