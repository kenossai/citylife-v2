<?php

namespace App\Filament\Resources\CourseLessons\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CourseLessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Select::make('course_id')
                            ->label('Course')
                            ->relationship('course', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(150)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(150),
                        TextInput::make('lesson_number')
                            ->label('Lesson Number')
                            ->numeric()
                            ->default(1)
                            ->required(),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        RichEditor::make('content')
                            ->label('Lesson Content')
                            ->columnSpanFull(),
                        Textarea::make('quiz_questions')
                            ->label('Quiz Questions (JSON format)')
                            ->rows(4)
                            ->columnSpanFull(),
                        Toggle::make('is_published')
                            ->label('Published'),
                        DatePicker::make('available_date')
                            ->label('Available Date'),
                    ]),
            ]);
    }
}
