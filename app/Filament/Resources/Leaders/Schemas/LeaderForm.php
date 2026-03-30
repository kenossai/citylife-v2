<?php

namespace App\Filament\Resources\Leaders\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeaderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Leader Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(150)
                            ->columnSpanFull(),
                        TextInput::make('role')
                            ->required()
                            ->placeholder('Lead Pastor')
                            ->maxLength(150),
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first.'),
                        TextInput::make('image_path')
                            ->label('Image Path / URL')
                            ->maxLength(300)
                            ->columnSpanFull(),
                        Textarea::make('bio')
                            ->label('Biography')
                            ->rows(6)
                            ->helperText('Separate paragraphs with a blank line.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Social Links')
                    ->columns(2)
                    ->schema([
                        TextInput::make('social_instagram')
                            ->label('Instagram URL')
                            ->maxLength(300),
                        TextInput::make('social_twitter')
                            ->label('X / Twitter URL')
                            ->maxLength(300),
                        TextInput::make('social_youtube')
                            ->label('YouTube URL')
                            ->maxLength(300),
                        TextInput::make('social_facebook')
                            ->label('Facebook URL')
                            ->maxLength(300),
                    ]),

                Section::make('Visibility')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Featured (Lead Pastor)')
                            ->helperText('Featured leaders display with full bio on the leadership page.'),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
