<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Course Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(150)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(150)
                            ->helperText('Auto-generated from the title. Used in the URL.'),
                        TextInput::make('category')
                            ->placeholder('Bible Study, Theology, Leadership…')
                            ->maxLength(100),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Instructor')
                    ->columns(2)
                    ->schema([
                        Select::make('leader_id')
                            ->label('Instructor (from Leadership)')
                            ->relationship('leader', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Select a pastor / leader…')
                            ->helperText('Leave empty and use Guest Instructor below for external instructors.')
                            ->nullable(),
                        TextInput::make('guest_instructor_name')
                            ->label('Guest Instructor')
                            ->placeholder('Guest instructor name')
                            ->maxLength(150)
                            ->helperText('Only fill this if the instructor is not one of our leaders.'),
                    ]),

                Section::make('Schedule')
                    ->columns(2)
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Start Date'),
                        DatePicker::make('end_date')
                            ->label('End Date'),
                    ]),

                Section::make('Media')
                    ->schema([
                        TextInput::make('image_path')
                            ->label('Image Path / URL')
                            ->maxLength(300),
                    ]),

                Section::make('Settings')
                    ->columns(3)
                    ->schema([
                        Toggle::make('has_certificate')
                            ->label('Certificate on Completion'),
                        Toggle::make('is_membership_course')
                            ->label('Membership Entry Course')
                            ->helperText('Approval upgrades student to active member (e.g. CDC).'),
                        Toggle::make('is_registration_open')
                            ->label('Registration Open'),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
