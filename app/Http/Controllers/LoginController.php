<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function showLoginForm () {
        if(auth()->check()) {
            return redirect('dashboard');
        }
        return view('user-auth.login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withInput($request->only('email'))
                ->with('error', 'No account found with this email.');
        }

        // Check for admin roles
        if (in_array($user->user_role, ['super_admin', 'regional_admin', 'moderator'])) {
            return redirect()->route('admin.login.form')
                ->with('error', 'Please use the admin login page for admin accounts.');
        }

        if (!\Hash::check($request->password, $user->password)) {
            return back()->withInput($request->only('email'))
                ->with('error', 'Incorrect password.');
        }

        if($user->status !== 'active') {
            return back()->withInput($request->only('email'))
                ->with('error', 'Your account is suspended temporairly. Please contact support.');
        }

        Auth::login($user, $request->filled('remember'));
        $request->session()->regenerate();
        Auth::user()->update(['last_login_at' => now()]);
        
        return redirect('dashboard')->with('toast_success', 'Login successful! Welcome back.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('toast_success', 'You have been logged out.');
    }
}
