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
            $this->promoteMemberIfEligible($enrollment);
        }
    }

    private function createGraduateRecord(CourseEnrollment $enrollment): void
    {
        $enrollment->loadMissing('course');

        $certificateIssued = $enrollment->certificate_issued
            || ($enrollment->course?->has_certificate ?? false);

        Graduate::firstOrCreate(
            ['course_enrollment_id' => $enrollment->id],
            [
                'member_id'          => $enrollment->member_id,
                'course_id'          => $enrollment->course_id,
                'graduated_at'       => $enrollment->completed_at ?? now(),
                'certificate_issued' => $certificateIssued,
            ]
        );
    }

    private function promoteMemberIfEligible(CourseEnrollment $enrollment): void
    {
        $enrollment->loadMissing(['member', 'course']);

        if (! $enrollment->course?->is_membership_course) {
            return;
        }

        $member = $enrollment->member;

        if (! $member) {
            return;
        }

        if ($member->membership_status !== 'member') {
            $member->update([
                'membership_status' => 'member',
                'membership_date'   => $enrollment->completed_at?->toDateString() ?? now()->toDateString(),
            ]);
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
