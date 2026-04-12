<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Mail\MemberPasswordResetMail;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class MemberAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('member.dashboard');
        }

        return view('member.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('member')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('member.dashboard'));
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('member.login');
    }

    public function showSetupPassword(string $token)
    {
        $member = Member::where('password_setup_token', $token)
            ->where('password_setup_token_expires_at', '>', now())
            ->firstOrFail();

        return view('member.setup-password', compact('member', 'token'));
    }

    public function setupPassword(Request $request, string $token)
    {
        $member = Member::where('password_setup_token', $token)
            ->where('password_setup_token_expires_at', '>', now())
            ->firstOrFail();

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $member->update([
            'password'                         => Hash::make($request->password),
            'password_setup_token'             => null,
            'password_setup_token_expires_at'  => null,
        ]);

        Auth::guard('member')->login($member);
        $request->session()->regenerate();

        return redirect()->route('member.dashboard')
            ->with('status', 'Password created! Welcome to your dashboard.');
    }

    // ── Forgot / Reset Password ────────────────────────────────────────────────

    public function showForgotPassword()
    {
        return view('member.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Rate-limit: 5 attempts per email per minute
        $throttleKey = 'member-reset:' . Str::lower($request->email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Too many reset attempts. Please wait {$seconds} seconds before trying again.",
            ]);
        }

        RateLimiter::hit($throttleKey, 60);

        $member = Member::where('email', $request->email)->first();

        // Always show the same response to prevent user enumeration
        if ($member) {
            $token    = $member->generatePasswordResetToken();
            $resetUrl = route('member.password.reset', $token);
            Mail::to($member->email)->send(new MemberPasswordResetMail($member, $resetUrl));
        }

        return back()->with('status', 'If that email address is registered, you will receive a password reset link shortly.');
    }

    public function showResetPassword(string $token)
    {
        $member = Member::where('password_setup_token', $token)
            ->where('password_setup_token_expires_at', '>', now())
            ->first();

        if (! $member) {
            return redirect()->route('member.password.request')
                ->withErrors(['email' => 'This password reset link is invalid or has expired.']);
        }

        return view('member.reset-password', compact('token'));
    }

    public function resetPassword(Request $request, string $token)
    {
        $member = Member::where('password_setup_token', $token)
            ->where('password_setup_token_expires_at', '>', now())
            ->first();

        if (! $member) {
            return redirect()->route('member.password.request')
                ->withErrors(['email' => 'This password reset link is invalid or has expired.']);
        }

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $member->update([
            'password'                        => Hash::make($request->password),
            'password_setup_token'            => null,
            'password_setup_token_expires_at' => null,
        ]);

        return redirect()->route('member.login')
            ->with('status', 'Your password has been reset. You can now sign in.');
    }
}
