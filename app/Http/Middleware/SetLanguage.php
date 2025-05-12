<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has a preferred language
        if (Auth::check() && Auth::user()->preferred_language) {
            App::setLocale(Auth::user()->preferred_language);
        } 
        // Check if session has a language set
        else if ($request->session()->has('locale')) {
            App::setLocale($request->session()->get('locale'));
        }
        
        return $next($request);
    }
}
