<?php

namespace App\Filament\Resources\Sermons\Schemas;

use App\Models\Leader;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
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
                        Select::make('leader_id')
                            ->label('Pastor / Speaker')
                            ->relationship('leader', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Select a pastor…')
                            ->helperText('Leave empty and use Guest Speaker below for external speakers.')
                            ->nullable(),
                        TextInput::make('guest_speaker_name')
                            ->label('Guest Speaker')
                            ->placeholder('Guest speaker name')
                            ->maxLength(150)
                            ->helperText('Only fill this if the speaker is not one of our pastors.'),
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
