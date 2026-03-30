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
                            ->maxLength(80),
                        TextInput::make('subtitle')
                            ->placeholder('Ages 13 – 25')
                            ->maxLength(100),
                        Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('image_path')
                            ->label('Image Path / URL')
                            ->maxLength(300)
                            ->columnSpanFull(),
                    ]),

                Section::make('Category & Icon')
                    ->columns(2)
                    ->schema([
                        TextInput::make('category_label')
                            ->label('Category Tag')
                            ->placeholder('Youth')
                            ->maxLength(30),
                        TextInput::make('category_color')
                            ->label('Category Tag Color')
                            ->placeholder('bg-red-500')
                            ->maxLength(60),
                        Textarea::make('icon_svg_path')
                            ->label('SVG Path Data')
                            ->required()
                            ->rows(3)
                            ->helperText('The d="..." attribute value of the SVG <path> element.')
                            ->columnSpanFull(),
                        TextInput::make('icon_bg_class')
                            ->label('Icon Background Class')
                            ->placeholder('bg-yellow-400')
                            ->required(),
                        TextInput::make('icon_text_class')
                            ->label('Icon Text / Color Class')
                            ->placeholder('text-white')
                            ->required(),
                    ]),

                Section::make('Schedule & Leader')
                    ->columns(2)
                    ->schema([
                        TextInput::make('meeting_schedule')
                            ->label('Meeting Schedule')
                            ->placeholder('Fridays · 7:00 PM')
                            ->maxLength(150),
                        TextInput::make('leader_name')
                            ->label('Leader Name')
                            ->placeholder('Ps. Daniel Wright')
                            ->maxLength(100),
                    ]),

                Section::make('Appearance & Settings')
                    ->columns(2)
                    ->schema([
                        TextInput::make('button_gradient')
                            ->label('Button Gradient Classes')
                            ->placeholder('from-red-500 to-orange-400')
                            ->maxLength(100),
                        TextInput::make('link_url')
                            ->label('Link URL')
                            ->placeholder('/ministries/youth')
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
