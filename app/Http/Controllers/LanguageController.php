<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    /**
     * Update the language preference.
     * 
     * This works for both authenticated and guest users.
     * For authenticated users, it updates their preferred_language in the database.
     * For guests, it stores the language preference in the session.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required|in:en,dari,pashto',
        ]);
        
        // If user is authenticated, update their preference in the database
        if (Auth::check()) {
            $user = auth()->user();
            $user->preferred_language = $validated['language'];
            $user->save();
        }
        
        // For all users (including guests), store the preference in the session
        $request->session()->put('locale', $validated['language']);
        
        return redirect()->back()
            ->with('success', __('messages.language_updated'));
    }
}
