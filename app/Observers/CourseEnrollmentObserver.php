<?php

namespace App\Observers;

use App\Mail\CourseEnrollmentApprovedMail;
use App\Models\CourseEnrollment;
use Illuminate\Support\Facades\Mail;

class CourseEnrollmentObserver
{
    public function created(CourseEnrollment $enrollment): void
    {
        if ($enrollment->status === 'active') {
            $enrollment->loadMissing(['member', 'course']);
            $this->sendApprovalEmail($enrollment);
        }
    }

    public function updated(CourseEnrollment $enrollment): void
    {
        if (! $enrollment->wasChanged('status')) {
            return;
        }

        $enrollment->loadMissing(['member', 'course']);

        if ($enrollment->status === 'active') {
            $this->sendApprovalEmail($enrollment);
        }
    }

    private function sendApprovalEmail(CourseEnrollment $enrollment): void
    {
        if ($enrollment->member?->email) {
            // Generate a password-setup token for first-time members
            if (! $enrollment->member->password) {
                $enrollment->member->generatePasswordSetupToken();
                $enrollment->member->refresh();
            }

            Mail::to($enrollment->member->email)
                ->send(new CourseEnrollmentApprovedMail($enrollment));
        } elseif ($enrollment->guest_email) {
            Mail::to($enrollment->guest_email)
                ->send(new CourseEnrollmentApprovedMail($enrollment));
        }
    }
}
