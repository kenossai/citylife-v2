<?php

namespace App\Filament\Resources\CourseLessons\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
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
                        TextInput::make('week_group')
                            ->label('Week / Module Group')
                            ->placeholder('e.g. Week 1-2 — The Nature of Prayer')
                            ->maxLength(100)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        RichEditor::make('content')
                            ->label('Lesson Content')
                            ->columnSpanFull(),
                        Toggle::make('is_published')
                            ->label('Published'),
                        DatePicker::make('available_date')
                            ->label('Available Date'),
                    ]),

                Section::make('Quiz Questions')
                    ->description('Add multiple-choice questions for this lesson\'s quiz. Leave empty if no quiz is needed.')
                    ->collapsible()
                    ->schema([
                        Repeater::make('quiz_questions')
                            ->label('')
                            ->schema([
                                TextInput::make('question')
                                    ->label('Question')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('options.0')->label('Option A')->required(),
                                TextInput::make('options.1')->label('Option B')->required(),
                                TextInput::make('options.2')->label('Option C')->nullable(),
                                TextInput::make('options.3')->label('Option D')->nullable(),
                                Select::make('answer')
                                    ->label('Correct Answer')
                                    ->options([
                                        0 => 'Option A',
                                        1 => 'Option B',
                                        2 => 'Option C',
                                        3 => 'Option D',
                                    ])
                                    ->required(),
                            ])
                            ->columns(2)
                            ->addActionLabel('Add Question')
                            ->defaultItems(0)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['question'] ?? null),
                    ]),
            ]);
    }
}
