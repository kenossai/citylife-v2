<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
}
