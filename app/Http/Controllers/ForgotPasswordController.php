<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email.'])->withInput();
        }

        $token = Str::random(64);

        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]
        );

        $resetLink = url('/reset-password/' . $token . '?email=' . urlencode($user->email));
        try {
            Mail::raw(
                "You requested a password reset for your Ulixai account.\n\nClick the link below to reset your password:\n\n$resetLink\n\nIf you did not request this, please ignore this email.",
                function ($message) use ($user) {
                    $fromAddress = config('mail.from.address') ?: 'noreply@ulixai.com';
                    $fromName = config('mail.from.name') ?: 'Ulixai';
                    $message->to($user->email)
                            ->from($fromAddress, $fromName)
                            ->subject('Ulixai - Password Reset');
                }
            );
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send reset email. Please try again later.'])->withInput();
        }
        

        return back()->with('status', 'A password reset link has been sent to your email.');
    }

    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');
        return view('user-auth.password_reset', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['email' => 'Invalid or expired reset token.']);
        }

        // Token expires after 60 minutes
        if (Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'This reset token has expired. Please request a new one.']);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No user found.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/login')->with('toast_success', 'Password reset successful. You can now log in.');
    }
}
