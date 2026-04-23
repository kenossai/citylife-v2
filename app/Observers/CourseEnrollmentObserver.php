<?php

namespace App\Observers;

use App\Mail\CourseEnrollmentApprovedMail;
use App\Models\CourseEnrollment;
use App\Models\Graduate;
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

        if ($enrollment->status === 'completed') {
            $this->createGraduateRecord($enrollment);
        }
    }

    private function createGraduateRecord(CourseEnrollment $enrollment): void
    {
        Graduate::firstOrCreate(
            ['course_enrollment_id' => $enrollment->id],
            [
                'member_id'          => $enrollment->member_id,
                'course_id'          => $enrollment->course_id,
                'graduated_at'       => $enrollment->completed_at ?? now(),
                'certificate_issued' => $enrollment->certificate_issued ?? false,
            ]
        );
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
