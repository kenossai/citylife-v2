<?php

namespace App\Filament\Resources\Ministries\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MinistryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ministry Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(80)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Icon')
                    ->columns(2)
                    ->schema([
                        Textarea::make('icon_svg_path')
                            ->label('SVG Path Data')
                            ->required()
                            ->rows(3)
                            ->helperText('The d="..." attribute value of the SVG <path> element.')
                            ->columnSpanFull(),
                        TextInput::make('icon_bg_class')
                            ->label('Icon Background Class')
                            ->placeholder('bg-orange-50')
                            ->required(),
                        TextInput::make('icon_text_class')
                            ->label('Icon Text / Color Class')
                            ->placeholder('text-[#e85d26]')
                            ->required(),
                    ]),

                Section::make('Settings')
                    ->columns(2)
                    ->schema([
                        TextInput::make('link_url')
                            ->label('Link URL')
                            ->placeholder('/our-ministry')
                            ->maxLength(200),
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
