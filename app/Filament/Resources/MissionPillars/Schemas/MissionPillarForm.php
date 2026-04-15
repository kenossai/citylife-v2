<?php

namespace App\Filament\Resources\MissionPillars\Schemas;

use App\Models\Leader;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MissionPillarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pillar Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(120)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Image & Display')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Pillar Image')
                            ->image()
                            ->disk('public')
                            ->directory('mission-pillars')
                            ->columnSpanFull(),
                        Select::make('leaders')
                            ->label('Leaders In Charge')
                            ->relationship('leaders', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->placeholder('Select one or more leaders…')
                            ->columnSpanFull(),
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
