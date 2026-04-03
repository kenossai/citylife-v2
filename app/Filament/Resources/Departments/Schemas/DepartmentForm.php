<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Department Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(120)
                            ->helperText('Auto-generated from the name. Used in the URL.'),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        Select::make('leader_id')
                            ->label('Department Head')
                            ->relationship('leader', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->placeholder('Select a leader…')
                            ->columnSpanFull(),
                        FileUpload::make('image_path')
                            ->label('Department Image')
                            ->image()
                            ->disk('public')
                            ->directory('departments')
                            ->maxSize(2048)
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
