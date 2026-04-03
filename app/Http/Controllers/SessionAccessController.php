<?php

namespace App\Http\Controllers;

use App\Mail\SessionAccessCodeMail;
use App\Models\SessionAccessCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SessionAccessController extends Controller
{
    /**
     * Send a 6-digit verification code to the given email.
     */
    public function sendCode(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'speaker_slug' => ['required', 'string', 'max:100'],
        ]);

        $code = 'BS' . str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        // Expire any previous unused codes for this email + speaker
        SessionAccessCode::where('email', $validated['email'])
            ->where('speaker_slug', $validated['speaker_slug'])
            ->where('verified', false)
            ->delete();

        $accessCode = SessionAccessCode::create([
            'email' => $validated['email'],
            'code' => $code,
            'speaker_slug' => $validated['speaker_slug'],
            'expires_at' => now()->addMinutes(15),
        ]);

        Mail::to($validated['email'])->send(new SessionAccessCodeMail($code));

        return response()->json([
            'success' => true,
            'message' => 'Verification code sent.',
        ]);
    }

    /**
     * Verify the 6-digit code.
     */
    public function verifyCode(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'code' => ['required', 'string', 'size:6', 'regex:/^BS\d{4}$/'],
            'speaker_slug' => ['required', 'string', 'max:100'],
        ]);

        $accessCode = SessionAccessCode::where('email', $validated['email'])
            ->where('code', $validated['code'])
            ->where('speaker_slug', $validated['speaker_slug'])
            ->where('verified', false)
            ->where('expires_at', '>', now())
            ->first();

        if (! $accessCode) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired code.',
            ], 422);
        }

        $accessCode->update(['verified' => true, 'last_used_at' => now()]);

        // Store verified access in the user's session
        $unlocked = session('unlocked_speakers', []);
        $unlocked[$validated['speaker_slug']] = $validated['email'];
        session(['unlocked_speakers' => $unlocked]);

        return response()->json([
            'success' => true,
            'message' => 'Sessions unlocked!',
        ]);
    }
}
