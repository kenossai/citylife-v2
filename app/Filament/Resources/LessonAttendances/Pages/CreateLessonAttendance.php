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
        $rawState      = $this->form->getRawState();
        $enrollmentIds = $rawState['enrollment_ids'] ?? [];
        $lessonIds     = $rawState['lesson_ids'] ?? [];
        $last          = null;

        foreach ((array) $enrollmentIds as $enrollmentId) {
            foreach ((array) $lessonIds as $lessonId) {
                $last = LessonAttendance::create([
                    'enrollment_id' => $enrollmentId,
                    'lesson_id'     => $lessonId,
                    'attended_at'   => $data['attended_at'],
                    'present'       => $data['present'] ?? true,
                ]);
            }
        }

        // Filament requires a Model back — return the last created record
        return $last ?? LessonAttendance::create($data);
    }
}
