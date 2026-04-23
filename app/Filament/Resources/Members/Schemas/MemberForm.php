<?php

namespace App\Filament\Resources\Members\Schemas;

use App\Models\Member;
use App\Services\ChurchSuiteService;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->columns(3)
                    ->schema([
                        TextInput::make('membership_number')
                            ->label('Membership Number')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Auto-generated on save')
                            ->visibleOn('edit')
                            ->columnSpanFull(),
                        Select::make('title')
                            ->options([
                                'Mr'      => 'Mr',
                                'Mrs'     => 'Mrs',
                                'Ms'      => 'Ms',
                                'Miss'    => 'Miss',
                                'Dr'      => 'Dr',
                                'Pastor'  => 'Pastor',
                                'Rev'     => 'Rev',
                                'Elder'   => 'Elder',
                                'Deacon'  => 'Deacon',
                                'Deaconess' => 'Deaconess',
                            ])
                            ->placeholder('Select an option'),
                        TextInput::make('first_name')
                            ->label('First name')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('last_name')
                            ->label('Last name')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->maxLength(150),
                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(30),
                        DatePicker::make('date_of_birth')
                            ->label('Date of birth')
                            ->columnStart(1),
                        Select::make('gender')
                            ->options([
                                'male'   => 'Male',
                                'female' => 'Female',
                            ]),
                        Select::make('marital_status')
                            ->options([
                                'single'   => 'Single',
                                'married'  => 'Married',
                                'divorced' => 'Divorced',
                                'widowed'  => 'Widowed',
                            ]),
                        Toggle::make('is_spouse_member')
                            ->label('Is spouse a member?')
                            ->live()
                            ->columnSpan(1),
                        Select::make('spouse_id')
                            ->label('Select Spouse')
                            ->relationship('spouse', 'first_name')
                            ->getOptionLabelFromRecordUsing(fn (Member $record) => "{$record->first_name} {$record->last_name}")
                            ->searchable()
                            ->preload()
                            ->placeholder('Select spouse from members')
                            ->visible(fn ($get) => $get('is_spouse_member'))
                            ->columnSpan(2),
                        TextInput::make('occupation')
                            ->maxLength(150)
                            ->columnSpanFull(),
                    ]),

                Section::make('Address Information')
                    ->columns(3)
                    ->schema([
                        Textarea::make('address')
                            ->rows(2)
                            ->columnSpanFull(),
                        TextInput::make('city')
                            ->maxLength(100),
                        TextInput::make('postcode')
                            ->label('Postal code')
                            ->maxLength(20),
                        TextInput::make('country')
                            ->default('United Kingdom')
                            ->maxLength(100),
                    ]),

                Section::make('Church Information')
                    ->columns(2)
                    ->schema([
                        Select::make('membership_status')
                            ->options([
                                'visitor'     => 'Visitor',
                                'new_convert' => 'New Convert',
                                'member'      => 'Member',
                                'inactive'    => 'Inactive',
                                'transferred' => 'Transferred',
                                'deceased'    => 'Deceased',
                            ])
                            ->default('visitor')
                            ->required(),
                        DatePicker::make('first_visit_date')
                            ->label('First visit date')
                            ->required(),
                        DatePicker::make('membership_date')
                            ->label('Membership date'),
                        Select::make('baptism_status')
                            ->options([
                                'baptised'     => 'Baptised',
                                'not_baptised' => 'Not Baptised',
                            ]),
                        DatePicker::make('baptism_date')
                            ->label('Baptism date')
                            ->columnSpanFull(),
                    ]),

                Section::make('Additional Information')
                    ->schema([
                        Textarea::make('notes')
                            ->rows(3),
                        Toggle::make('is_active')
                            ->label('Is active')
                            ->default(true),
                    ]),

                Section::make('ChurchSuite CRM')
                    ->description('Read-only sync status. Use the "Sync to ChurchSuite" button to push updates.')
                    ->columns(2)
                    ->visible(fn () => app(ChurchSuiteService::class)->isConfigured())
                    ->visibleOn('edit')
                    ->schema([
                        TextInput::make('churchsuite_id')
                            ->label('ChurchSuite Contact ID')
                            ->disabled()
                            ->dehydrated(false),
                        TextInput::make('churchsuite_sync_status')
                            ->label('Sync Status')
                            ->disabled()
                            ->dehydrated(false)
                            ->formatStateUsing(fn (?string $state) => $state ? ucfirst($state) : 'Not synced'),
                        Placeholder::make('churchsuite_synced_at')
                            ->label('Last Synced')
                            ->content(fn (?Member $record) => $record?->churchsuite_synced_at?->diffForHumans() ?? '—'),
                        Placeholder::make('churchsuite_sync_error')
                            ->label('Last Error')
                            ->content(fn (?Member $record) => $record?->churchsuite_sync_error ?? '—'),
                    ]),
            ]);
    }
}
