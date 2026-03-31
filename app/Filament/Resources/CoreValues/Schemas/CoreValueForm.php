<?php

namespace App\Filament\Resources\CoreValues\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CoreValueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Core Value Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('tag')
                            ->required()
                            ->placeholder('Prayer')
                            ->maxLength(40),
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first.'),
                        TextInput::make('heading')
                            ->required()
                            ->maxLength(200)
                            ->columnSpanFull(),
                        TextInput::make('image_path')
                            ->label('Image Path / URL')
                            ->maxLength(300)
                            ->columnSpanFull(),
                        Textarea::make('body_1')
                            ->label('Body Paragraph 1')
                            ->rows(3)
                            ->columnSpanFull(),
                        Textarea::make('body_2')
                            ->label('Body Paragraph 2')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Scripture Quote')
                    ->columns(2)
                    ->schema([
                        Textarea::make('quote')
                            ->label('Quote Text')
                            ->rows(2)
                            ->columnSpanFull(),
                        TextInput::make('scripture')
                            ->label('Scripture Reference')
                            ->placeholder('Colossians 4:2')
                            ->maxLength(80),
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
