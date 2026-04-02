<?php

namespace App\Observers;

use App\Mail\CourseEnrollmentApprovedMail;
use App\Models\CourseEnrollment;
use Illuminate\Support\Facades\Mail;

class CourseEnrollmentObserver
{
    public function updated(CourseEnrollment $enrollment): void
    {
        if (! $enrollment->wasChanged('status')) {
            return;
        }

        $enrollment->loadMissing(['member', 'course']);

        // Approved → send enrollment confirmation email to student
        if ($enrollment->status === 'active') {
            if ($enrollment->member?->email) {
                // Generate a password-setup token for first-time members
                if (! $enrollment->member->password) {
                    $enrollment->member->generatePasswordSetupToken();
                    // Refresh so the mailable sees the new token
                    $enrollment->member->refresh();
                }

                Mail::to($enrollment->member->email)
                    ->send(new CourseEnrollmentApprovedMail($enrollment));
            }
        }
    }
}
