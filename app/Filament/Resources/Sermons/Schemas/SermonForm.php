<?php

namespace App\Filament\Resources\Sermons\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SermonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Sermon Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(150)
                            ->columnSpanFull(),
                        TextInput::make('speaker')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('scripture')
                            ->label('Scripture Reference')
                            ->placeholder('Galatians 5')
                            ->maxLength(100),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        DatePicker::make('preached_at')
                            ->label('Date Preached')
                            ->required(),
                        TextInput::make('service_label')
                            ->label('Service Label')
                            ->placeholder('Sunday Morning Service')
                            ->maxLength(100),
                    ]),

                Section::make('Media')
                    ->columns(2)
                    ->schema([
                        TextInput::make('thumbnail_path')
                            ->label('Thumbnail Path / URL')
                            ->maxLength(300),
                        TextInput::make('video_url')
                            ->label('Video URL')
                            ->maxLength(300),
                    ]),

                Section::make('Visibility')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Featured on Homepage')
                            ->helperText('Only one sermon should be featured at a time.'),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
