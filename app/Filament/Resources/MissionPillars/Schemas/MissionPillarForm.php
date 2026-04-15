<?php

namespace App\Filament\Resources\MissionPillars\Schemas;

use App\Models\Leader;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
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
                        TextInput::make('slug')
                            ->maxLength(120)
                            ->helperText('Auto-generated from title if left blank. e.g. "church-planting"')
                            ->columnSpanFull(),
                        TextInput::make('subtitle')
                            ->label('Subtitle / Tagline')
                            ->maxLength(150)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->helperText('Short description shown on listing cards.')
                            ->columnSpanFull(),
                        Textarea::make('about_text')
                            ->label('About Text (Detail Page)')
                            ->rows(5)
                            ->helperText('Full body text shown on the detail page. Separate paragraphs with blank lines.')
                            ->columnSpanFull(),
                        TextInput::make('vision_quote')
                            ->label('Vision Quote')
                            ->maxLength(400)
                            ->helperText('Optional pull-quote shown on detail page.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Image & Gallery')
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Main Image')
                            ->image()
                            ->disk('public')
                            ->directory('mission-pillars')
                            ->columnSpanFull(),
                        Repeater::make('gallery_images')
                            ->label('Gallery Images')
                            ->schema([
                                TextInput::make('url')
                                    ->label('Image URL')
                                    ->required()
                                    ->maxLength(400),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Section::make('Leaders & Display')
                    ->columns(2)
                    ->schema([
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
