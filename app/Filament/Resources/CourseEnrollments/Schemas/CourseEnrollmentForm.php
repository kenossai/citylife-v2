<?php

namespace App\Filament\Resources\CourseEnrollments\Schemas;

use App\Models\Course;
use App\Models\Member;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\Column;

class CourseEnrollmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Enrollment Details')->schema([
                Grid::make(1)->schema([
                    Select::make('course_id')
                        ->label('Course')
                        ->options(Course::active()->pluck('title', 'id'))
                        ->searchable()
                        ->required(),

                    Toggle::make('is_guest')
                        ->label('Enrolling someone not in the system?')
                        ->default(false)
                        ->dehydrated(false)
                        ->live()
                        ->afterStateHydrated(fn ($component, $record) =>
                            $component->state($record && ! $record->member_id ? true : false)
                        )
                        ->columnStart(1),
                ]),

                Grid::make(2)->schema([
                    Select::make('member_id')
                        ->label('Member')
                        ->options(
                            Member::active()
                                ->get()
                                ->mapWithKeys(fn ($m) => [$m->id => "{$m->first_name} {$m->last_name} ({$m->membership_number})"])
                        )
                        ->searchable()
                        ->required(fn ($get) => ! $get('is_guest'))
                        ->visible(fn ($get) => ! $get('is_guest')),

                    TextInput::make('guest_name')
                        ->label('Full Name')
                        ->maxLength(150)
                        ->required(fn ($get) => $get('is_guest'))
                        ->visible(fn ($get) => $get('is_guest')),

                    TextInput::make('guest_email')
                        ->label('Email Address')
                        ->email()
                        ->maxLength(150)
                        ->required(fn ($get) => $get('is_guest'))
                        ->visible(fn ($get) => $get('is_guest')),
                ]),

                Grid::make(2)->schema([
                    Select::make('status')
                        ->options([
                            'pending'   => 'Pending',
                            'active'    => 'Active (Approved)',
                            'completed' => 'Completed',
                            'cancelled' => 'Cancelled',
                            'suspended' => 'Suspended',
                        ])
                        ->default('pending')
                        ->required(),

                    TextInput::make('attendance_count')
                        ->label('Attendance Count')
                        ->numeric()
                        ->default(0)
                        ->minValue(0),
                ]),

                Grid::make(2)->schema([
                    DateTimePicker::make('enrolled_at')
                        ->label('Enrolled At')
                        ->nullable(),

                    DateTimePicker::make('completed_at')
                        ->label('Completed At')
                        ->nullable(),
                ]),

                Toggle::make('certificate_issued')
                    ->label('Certificate Issued')
                    ->default(false),
            ]),
        ]);
    }
}
