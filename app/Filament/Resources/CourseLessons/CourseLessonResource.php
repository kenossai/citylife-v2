<?php

namespace App\Filament\Resources\CourseLessons;

use App\Filament\Resources\CourseLessons\Pages\CreateCourseLesson;
use App\Filament\Resources\CourseLessons\Pages\EditCourseLesson;
use App\Filament\Resources\CourseLessons\Pages\ListCourseLessons;
use App\Filament\Resources\CourseLessons\Schemas\CourseLessonForm;
use App\Filament\Resources\CourseLessons\Tables\CourseLessonsTable;
use App\Models\CourseLesson;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CourseLessonResource extends Resource
{
    protected static ?string $model = CourseLesson::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    public static function getNavigationGroup(): ?string { return 'Courses'; }
    public static function getNavigationLabel(): string  { return 'Course Lessons'; }
    public static function getNavigationSort(): ?int     { return 4; }
    public static function getNavigationParentItem(): ?string { return 'Courses'; }

    public static function form(Schema $schema): Schema
    {
        return CourseLessonForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CourseLessonsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCourseLessons::route('/'),
            'create' => CreateCourseLesson::route('/create'),
            'edit' => EditCourseLesson::route('/{record}/edit'),
        ];
    }
}
