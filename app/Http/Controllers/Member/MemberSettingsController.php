<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class MemberSettingsController extends Controller
{
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ]);

        $member = Auth::guard('member')->user();

        if ($member->avatar_path) {
            Storage::disk('public')->delete($member->avatar_path);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $member->update(['avatar_path' => $path]);

        return back()->with('profile_status', 'Avatar updated successfully.');
    }

    public function show()
    {
        $member = Auth::guard('member')->user();

        return view('member.settings', compact('member'));
    }

    public function updateProfile(Request $request)
    {
        $member = Auth::guard('member')->user();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'max:255', 'unique:members,email,' . $member->id],
            'phone'      => ['nullable', 'string', 'max:30'],
            'city'       => ['nullable', 'string', 'max:100'],
            'bio'        => ['nullable', 'string', 'max:500'],
        ]);

        $member->update($validated);

        return back()->with('profile_status', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $member = Auth::guard('member')->user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password'         => ['required', 'string', 'confirmed', Password::min(8)],
        ]);

        if (! Hash::check($request->current_password, $member->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
        }

        $member->update(['password' => Hash::make($request->password)]);

        return back()->with('password_status', 'Password updated successfully.');
    }

    public function updateNotifications(Request $request)
    {
        $member = Auth::guard('member')->user();

        $member->update([
            'notify_study_reminders' => $request->boolean('notify_study_reminders'),
            'notify_quiz_results'    => $request->boolean('notify_quiz_results'),
            'notify_weekly_digest'   => $request->boolean('notify_weekly_digest'),
        ]);

        return back()->with('notifications_status', 'Notification preferences saved.');
    }

    public function deleteAccount(Request $request)
    {
        $member = Auth::guard('member')->user();

        $request->validate([
            'confirm_delete' => ['required', 'in:DELETE'],
        ], [
            'confirm_delete.in' => 'Please type DELETE to confirm.',
        ]);

        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $member->delete();

        return redirect()->route('member.login')
            ->with('status', 'Your account has been deleted.');
    }
}
