<?php

namespace App\Filament\Resources\LessonAttendances\Pages;

use App\Filament\Resources\LessonAttendances\LessonAttendanceResource;
use App\Models\LessonAttendance;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateLessonAttendance extends CreateRecord
{
    protected static string $resource = LessonAttendanceResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $enrollmentIds = $this->form->getRawState()['enrollment_ids'] ?? [];
        $last          = null;

        foreach ((array) $enrollmentIds as $enrollmentId) {
            $last = LessonAttendance::create([
                'enrollment_id' => $enrollmentId,
                'lesson_id'     => $data['lesson_id'],
                'attended_at'   => $data['attended_at'],
                'present'       => $data['present'] ?? true,
            ]);
        }

        // Filament requires a Model back — return the last created record
        return $last ?? LessonAttendance::create($data);
    }
}
