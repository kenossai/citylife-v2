<?php

namespace App\Filament\Resources\MissionCountries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MissionCountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Country Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('region')
                            ->label('Full Region Name')
                            ->placeholder('Democratic Republic of Congo')
                            ->maxLength(150),
                        TextInput::make('flag')
                            ->label('Flag Emoji')
                            ->placeholder('🇨🇩')
                            ->maxLength(20),
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0),
                        Select::make('type')
                            ->label('Mission Type')
                            ->options([
                                'home'   => 'Home',
                                'abroad' => 'Abroad',
                            ])
                            ->required()
                            ->default('abroad'),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
