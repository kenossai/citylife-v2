<?php

namespace App\Filament\Resources\LessonAttendances;

use App\Filament\Resources\LessonAttendances\Pages\CreateLessonAttendance;
use App\Filament\Resources\LessonAttendances\Pages\EditLessonAttendance;
use App\Filament\Resources\LessonAttendances\Pages\ListLessonAttendances;
use App\Filament\Resources\LessonAttendances\Schemas\LessonAttendanceForm;
use App\Filament\Resources\LessonAttendances\Tables\LessonAttendancesTable;
use App\Models\LessonAttendance;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LessonAttendanceResource extends Resource
{
    protected static ?string $model = LessonAttendance::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    public static function getNavigationGroup(): ?string { return 'Content'; }
    public static function getNavigationLabel(): string  { return 'Attendance'; }
    public static function getNavigationSort(): ?int     { return 6; }
    public static function getNavigationParentItem(): ?string { return 'Courses'; }

    public static function form(Schema $schema): Schema
    {
        return LessonAttendanceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LessonAttendancesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListLessonAttendances::route('/'),
            'create' => CreateLessonAttendance::route('/create'),
            'edit'   => EditLessonAttendance::route('/{record}/edit'),
        ];
    }
}
