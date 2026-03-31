<?php

namespace App\Filament\Resources\WorshipCentres\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WorshipCentreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Location Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('label')
                            ->required()
                            ->placeholder('City Centre')
                            ->maxLength(60),
                        TextInput::make('name')
                            ->required()
                            ->placeholder('Sheffield City Centre')
                            ->maxLength(120),
                        TextInput::make('address')
                            ->required()
                            ->placeholder('1 South Parade, Sheffield S1 2BJ')
                            ->maxLength(200)
                            ->columnSpanFull(),
                        TextInput::make('landmark')
                            ->placeholder('Behind Sheffield City Hall')
                            ->maxLength(150),
                        TextInput::make('times')
                            ->required()
                            ->placeholder('Sunday 9:00 AM and 11:00 AM')
                            ->maxLength(150),
                        TextInput::make('phone')
                            ->placeholder('+44 114 134 8912')
                            ->maxLength(30),
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first.'),
                    ]),

                Section::make('Visibility')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
