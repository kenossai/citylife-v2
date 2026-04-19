<?php

namespace App\Filament\Resources\Instructor;

use App\Filament\Pages\Instructor\TeachLessonPage;
use App\Filament\Resources\Instructor\Pages\ListInstructorCourses;
use App\Models\Course;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InstructorCourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPresentationChartBar;

    public static function getNavigationGroup(): ?string { return 'Instructor'; }
    public static function getNavigationLabel(): string  { return 'Teach a Course'; }
    public static function getNavigationSort(): ?int     { return 1; }

    public static function canCreate(): bool            { return false; }
    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool   { return false; }
    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('category')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('instructor_name')
                    ->label('Instructor')
                    ->getStateUsing(fn ($record) => $record->instructor_name),

                TextColumn::make('start_date')
                    ->label('Starts')
                    ->date('M j, Y')
                    ->sortable(),

                TextColumn::make('lessons_count')
                    ->label('Lessons')
                    ->counts('lessons')
                    ->sortable(),
            ])
            ->filters([])
            ->defaultSort('start_date', 'desc')
            ->recordActions([
                Action::make('teach')
                    ->label('Teach')
                    ->icon(Heroicon::OutlinedPlay)
                    ->color('primary')
                    ->url(fn ($record) => TeachLessonPage::getUrl(['course' => $record->id])),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInstructorCourses::route('/'),
        ];
    }
}
