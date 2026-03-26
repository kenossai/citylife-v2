<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HeroSlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Slide Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('eyebrow')
                            ->label('Eyebrow Text')
                            ->placeholder('— Pass It On')
                            ->maxLength(80),
                        TextInput::make('heading')
                            ->label('Heading')
                            ->required()
                            ->maxLength(120)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(2)
                            ->maxLength(300)
                            ->columnSpanFull(),
                    ]),

                Section::make('Image & Order')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Slide Image')
                            ->image()
                            ->disk('public')
                            ->directory('hero-slides')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
