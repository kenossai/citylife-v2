<?php

namespace App\Filament\Resources\Speakers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SpeakerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Speaker Details')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(150)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                        ->columnSpanFull(),

                    TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(200)
                        ->helperText('Auto-generated from name. Used in URLs.')
                        ->columnSpanFull(),

                    TextInput::make('role')
                        ->label('Title / Role')
                        ->placeholder('Senior Bishop & Principal')
                        ->maxLength(150),

                    TextInput::make('church')
                        ->label('Church / Organisation')
                        ->placeholder('City Life International Church')
                        ->maxLength(150),

                    TextInput::make('sort_order')
                        ->label('Sort Order')
                        ->numeric()
                        ->default(0)
                        ->helperText('Lower numbers appear first.'),

                    Textarea::make('bio')
                        ->label('Biography')
                        ->rows(6)
                        ->columnSpanFull(),
                ]),

            Section::make('Images')
                ->columns(2)
                ->schema([
                    FileUpload::make('image')
                        ->label('Profile Photo')
                        ->image()
                        ->disk('public')
                        ->directory('speakers')
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('3:4')
                        ->maxSize(2048)
                        ->helperText('Portrait photo, ideally 600×800px.'),

                    FileUpload::make('cover_image')
                        ->label('Cover / Banner Image')
                        ->image()
                        ->disk('public')
                        ->directory('speakers/covers')
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('16:9')
                        ->maxSize(4096)
                        ->helperText('Wide banner shown at the top of the speaker page.'),
                ]),

            Section::make('Visibility')
                ->columns(1)
                ->schema([
                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                ]),
        ]);
    }
}
