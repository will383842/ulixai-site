<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        $credentials = $request->only('email', 'password');
        $credentials['status'] = 'active';

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $admin = Auth::guard('admin')->user();
            if (!$admin->isAdmin()) {
                Auth::guard('admin')->logout();
                return back()->withInput($request->only('email'))
                    ->with('error', 'Access denied. Not an admin account.');
            }
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Welcome, admin!');
        }
        return back()->withInput($request->only('email'))
            ->with('error', 'Invalid credentials.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.form')->with('success', 'Logged out.');
    }
}
