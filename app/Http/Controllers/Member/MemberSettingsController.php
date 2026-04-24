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

    public function showChurchProfile()
    {
        $member = Auth::guard('member')->user();

        return view('member.church-profile', compact('member'));
    }

    public function updateChurchProfile(Request $request)
    {
        $member = Auth::guard('member')->user();

        // Assemble date_of_birth from the three separate inputs server-side
        $day   = str_pad((string) $request->input('dob_day', ''), 2, '0', STR_PAD_LEFT);
        $month = str_pad((string) $request->input('dob_month', ''), 2, '0', STR_PAD_LEFT);
        $year  = $request->input('dob_year', '');
        if ($day && $month && $year && $day !== '00' && $month !== '00') {
            $request->merge(['date_of_birth' => "{$year}-{$month}-{$day}"]);
        }

        $validated = $request->validate([
            'first_name'              => ['required', 'string', 'max:100'],
            'last_name'               => ['required', 'string', 'max:100'],
            'gender'                  => ['nullable', 'in:male,female,other'],
            'date_of_birth'           => ['required', 'date', 'before:today'],
            'email'                   => ['required', 'email', 'max:255', 'unique:members,email,' . $member->id],
            'phone'                   => ['required', 'string', 'max:30'],
            'address'                 => ['required', 'string', 'max:255'],
            'address_line_2'          => ['nullable', 'string', 'max:255'],
            'city'                    => ['required', 'string', 'max:100'],
            'county'                  => ['nullable', 'string', 'max:100'],
            'postcode'                => ['required', 'string', 'max:20'],
            'country'                 => ['required', 'string', 'max:100'],
            'marital_status'          => ['required', 'string', 'in:single,married,divorced,widowed,separated,prefer_not_to_say'],
            'data_protection_accepted'=> ['required', 'accepted'],
        ]);

        $validated['receive_general_email'] = $request->boolean('receive_general_email');
        $validated['receive_general_sms']   = $request->boolean('receive_general_sms');
        $validated['receive_rota_email']    = $request->boolean('receive_rota_email');
        $validated['receive_rota_sms']      = $request->boolean('receive_rota_sms');

        if (! $member->data_protection_accepted) {
            $validated['data_protection_accepted_at'] = now();
        }

        $member->update($validated);

        return back()->with('church_profile_status', 'Your details have been saved successfully.');
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
