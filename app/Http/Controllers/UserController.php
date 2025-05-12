<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        
        $users = User::with('department')->get();
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        
        $departments = Department::where('is_active', true)->get();
        
        return view('users.create', compact('departments'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|in:admin,user',
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
            'preferred_language' => 'required|in:en,dari,pashto',
        ]);
        
        $validated['password'] = Hash::make($validated['password']);
        
        User::create($validated);
        
        return redirect()->route('users.index')
            ->with('success', __('User created successfully'));
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        
        $departments = Department::where('is_active', true)->get();
        
        return view('users.edit', compact('user', 'departments'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|in:admin,user',
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
            'preferred_language' => 'required|in:en,dari,pashto',
        ]);
        
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            
            $validated['password'] = Hash::make($request->password);
        }
        
        $user->update($validated);
        
        return redirect()->route('users.index')
            ->with('success', __('User updated successfully'));
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        
        // Check if user has created documents
        if ($user->documents()->count() > 0) {
            return redirect()->route('users.index')
                ->with('error', __('Cannot delete user with associated documents'));
        }
        
        $user->delete();
        
        return redirect()->route('users.index')
            ->with('success', __('User deleted successfully'));
    }

    /**
     * Update the user's language preference.
     */
    public function updateLanguage(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required|in:en,dari,pashto',
        ]);
        
        $user = auth()->user();
        $user->preferred_language = $validated['language'];
        $user->save();
        
        return redirect()->back()
            ->with('success', __('Language preference updated successfully'));
    }
}
