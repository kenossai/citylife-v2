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
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(100)
                            ->helperText('URL-friendly name, e.g. "worship-and-arts"'),
                        TextInput::make('subtitle')
                            ->placeholder('Ages 13 – 25')
                            ->maxLength(100),
                        TextInput::make('image_path')
                            ->label('Image Path / URL')
                            ->maxLength(300),
                        Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->helperText('Short description shown on the listing cards.')
                            ->columnSpanFull(),
                        Textarea::make('about_text')
                            ->label('About Text (Detail Page)')
                            ->rows(5)
                            ->helperText('Full description shown on the ministry detail page. Separate paragraphs with blank lines.')
                            ->columnSpanFull(),
                        Textarea::make('vision_quote')
                            ->label('Vision / Mission Quote')
                            ->rows(2)
                            ->helperText('Highlighted quote block on the detail page.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Tags & Gallery')
                    ->columns(2)
                    ->schema([
                        TextInput::make('tags')
                            ->label('Tags (comma-separated)')
                            ->placeholder('Arts, Live Worship, Dance, Music')
                            ->helperText('Shown as pills on the detail page hero.')
                            ->columnSpanFull(),
                        Textarea::make('gallery_images')
                            ->label('Gallery Image URLs (one per line)')
                            ->rows(4)
                            ->helperText('Enter one image URL per line for the gallery section.')
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
                        TextInput::make('location')
                            ->label('Location / Venue')
                            ->placeholder('Main Auditorium')
                            ->maxLength(150),
                        TextInput::make('leader_name')
                            ->label('Leader Name')
                            ->placeholder('Ps. Daniel Wright')
                            ->maxLength(100),
                        TextInput::make('leader_role')
                            ->label('Leader Role')
                            ->placeholder('Ministry Lead')
                            ->maxLength(100),
                        TextInput::make('leader_image')
                            ->label('Leader Image URL')
                            ->maxLength(300)
                            ->columnSpanFull(),
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
