<?php

namespace App\Filament\Resources\SermonSeries\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SermonSeriesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Series Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(150)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(200)
                            ->helperText('Auto-generated from the title.')
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        ColorPicker::make('color')
                            ->label('Accent Colour')
                            ->helperText('Used for the series badge on the frontend.')
                            ->default('#e85d26'),
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0),
                    ]),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('thumbnail_path')
                            ->label('Series Thumbnail')
                            ->image()
                            ->directory('series-thumbnails')
                            ->columnSpanFull(),
                    ]),

                Section::make('Visibility')
                    ->schema([
                        Toggle::make('is_active')->label('Active')->default(true),
                    ]),
            ]);
    }
}
