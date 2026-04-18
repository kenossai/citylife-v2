<?php

namespace App\Filament\Resources\CourseEnrollments\Pages;

use App\Filament\Resources\CourseEnrollments\CourseEnrollmentResource;
use App\Models\Member;
use Filament\Resources\Pages\CreateRecord;

class CreateCourseEnrollment extends CreateRecord
{
    protected static string $resource = CourseEnrollmentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // If guest fields are present, auto-create a visitor Member account
        if (! empty($data['guest_name']) && ! empty($data['guest_email'])) {
            $nameParts  = explode(' ', trim($data['guest_name']), 2);
            $firstName  = $nameParts[0];
            $lastName   = $nameParts[1] ?? '';

            $member = Member::firstOrCreate(
                ['email' => strtolower($data['guest_email'])],
                [
                    'first_name'        => $firstName,
                    'last_name'         => $lastName,
                    'membership_status' => 'visitor',
                    'is_active'         => true,
                    'first_visit_date'  => now()->toDateString(),
                ]
            );

            $data['member_id']   = $member->id;
            $data['guest_name']  = null;
            $data['guest_email'] = null;
        }

        return $data;
    }
}
