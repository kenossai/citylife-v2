<?php

namespace App\Filament\Resources\BibleSchoolSessions\Schemas;

use App\Models\Speaker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BibleSchoolSessionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Session Details')
                ->columns(2)
                ->schema([
                    Select::make('speaker_id')
                        ->label('Speaker')
                        ->options(fn () => Speaker::active()->ordered()->pluck('name', 'id'))
                        ->searchable()
                        ->required()
                        ->columnSpanFull(),

                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                        ->columnSpanFull(),

                    TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Auto-generated. Must be unique per speaker.')
                        ->columnSpanFull(),

                    Select::make('type')
                        ->label('Type')
                        ->options(['video' => 'Video', 'audio' => 'Audio'])
                        ->required()
                        ->default('video')
                        ->live(),

                    TextInput::make('year')
                        ->label('Year')
                        ->numeric()
                        ->required()
                        ->default(date('Y'))
                        ->minValue(2000)
                        ->maxValue(2099),

                    TextInput::make('duration')
                        ->label('Duration')
                        ->placeholder('48:32')
                        ->maxLength(20)
                        ->helperText('Format: MM:SS'),

                    TextInput::make('sort_order')
                        ->label('Sort Order')
                        ->numeric()
                        ->default(0),

                    TextInput::make('scripture')
                        ->label('Scripture Reference')
                        ->placeholder('Hebrews 11:1-6')
                        ->maxLength(255),

                    Textarea::make('key_verse')
                        ->label('Key Verse')
                        ->rows(2)
                        ->placeholder('"Now faith is the substance of things hoped for…" — Hebrews 11:1')
                        ->columnSpanFull(),

                    Textarea::make('about')
                        ->label('Session Description')
                        ->rows(5)
                        ->columnSpanFull(),
                ]),

            Section::make('Media')
                ->columns(2)
                ->schema([
                    TextInput::make('youtube_id')
                        ->label('YouTube Video ID')
                        ->placeholder('dQw4w9WgXcQ')
                        ->maxLength(50)
                        ->helperText('The part after "watch?v=" in the YouTube URL.')
                        ->visible(fn ($get) => $get('type') !== 'audio'),

                    FileUpload::make('audio_file')
                        ->label('Audio File')
                        ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav', 'audio/ogg', 'audio/aac'])
                        ->disk('public')
                        ->directory('bible-school/audio')
                        ->maxSize(102400)
                        ->helperText('MP3 or similar. Max 100MB.')
                        ->visible(fn ($get) => $get('type') === 'audio'),
                ]),

            Section::make('Visibility')
                ->columns(2)
                ->schema([
                    Toggle::make('is_locked')
                        ->label('Locked (requires email unlock)')
                        ->default(true),
                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                ]),
        ]);
    }
}
