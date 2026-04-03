<?php

namespace App\Filament\Resources\Ministries\Schemas;

use App\Models\Leader;
use Filament\Forms\Components\Select;
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
            ->columns(1)
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
                        TextInput::make('category_label')
                            ->label('Category Tag')
                            ->placeholder('Youth')
                            ->maxLength(30),
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
                        Textarea::make('gallery_images')
                            ->label('Gallery Image URLs (one per line)')
                            ->rows(4)
                            ->helperText('Enter one image URL per line for the gallery section.')
                            ->columnSpanFull(),
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
                        Select::make('leader_id')
                            ->label('Ministry Leader')
                            ->relationship('leader', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->placeholder('Select a leader…')
                            ->helperText('Link to a leader in the system. If set, this overrides the manual name/image fields below.')
                            ->columnSpanFull(),
                        TextInput::make('leader_name')
                            ->label('Leader Name (manual fallback)')
                            ->placeholder('Ps. Daniel Wright')
                            ->maxLength(100)
                            ->helperText('Used only if no leader is selected above.'),
                        TextInput::make('leader_role')
                            ->label('Leader Role (manual fallback)')
                            ->placeholder('Ministry Lead')
                            ->maxLength(100)
                            ->helperText('Used only if no leader is selected above.'),
                        TextInput::make('leader_image')
                            ->label('Leader Image URL (manual fallback)')
                            ->maxLength(300)
                            ->helperText('Used only if no leader is selected above.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Settings')
                    ->columns(2)
                    ->schema([
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
