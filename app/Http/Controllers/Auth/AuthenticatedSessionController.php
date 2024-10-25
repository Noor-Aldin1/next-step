<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->role_id === 1) {
            return redirect()->intended(RouteServiceProvider::HOME); // Normal user
        } elseif ($user->role_id === 2) {
            return redirect()->intended(route('mentor.dashboard')); //mentor
        } elseif ($user->role_id === 3) {
            return redirect()->intended(route('employer.job_postings.dashbord')); //employer
        } elseif ($user->role_id === 4) {
            return redirect()->intended('admin/dashboard'); // Admin
        }


        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
