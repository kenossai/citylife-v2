<?php

namespace App\Filament\Resources\BibleSchoolEvents\Schemas;

use App\Models\Speaker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BibleSchoolEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Event Details')
                ->columns(2)
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                        ->columnSpanFull(),

                    TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Auto-generated from title. Must be unique.')
                        ->columnSpanFull(),

                    Textarea::make('description')
                        ->rows(4)
                        ->columnSpanFull(),

                    TextInput::make('year')
                        ->label('Year')
                        ->numeric()
                        ->required()
                        ->default(date('Y'))
                        ->minValue(2000)
                        ->maxValue(2099),

                    TextInput::make('location')
                        ->maxLength(255),

                    DatePicker::make('start_date')
                        ->label('Start Date')
                        ->required()
                        ->native(false),

                    DatePicker::make('end_date')
                        ->label('End Date')
                        ->native(false)
                        ->afterOrEqual('start_date'),

                    Select::make('status')
                        ->options([
                            'upcoming' => 'Upcoming',
                            'ongoing'  => 'Ongoing',
                            'past'     => 'Past',
                        ])
                        ->required()
                        ->default('upcoming'),

                    TextInput::make('sort_order')
                        ->label('Sort Order')
                        ->numeric()
                        ->default(0),

                    Select::make('speakers')
                        ->label('Speakers')
                        ->relationship('speakers', 'name')
                        ->options(fn () => Speaker::active()->ordered()->pluck('name', 'id'))
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->columnSpanFull(),
                ]),

            Section::make('Event Image')
                ->schema([
                    FileUpload::make('image')
                        ->label('Cover Image')
                        ->image()
                        ->disk('public')
                        ->directory('bible-school/events')
                        ->maxSize(5096),
                ]),
        ]);
    }
}
