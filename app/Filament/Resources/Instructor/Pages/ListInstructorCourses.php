<?php

namespace App\Filament\Resources\Instructor\Pages;

use App\Filament\Resources\Instructor\InstructorCourseResource;
use Filament\Resources\Pages\ListRecords;

class ListInstructorCourses extends ListRecords
{
    protected static string $resource = InstructorCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
