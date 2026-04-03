<?php

namespace App\Filament\Resources\Departments\Schemas;

use App\Models\Leader;
use App\Models\Member;
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
                        Select::make('head_type')
                            ->label('Department Head Type')
                            ->options([
                                'leader' => 'Leader',
                                'member' => 'Member',
                            ])
                            ->live()
                            ->nullable()
                            ->placeholder('Select type…')
                            ->afterStateUpdated(fn (callable $set) => $set('head_id', null)),
                        Select::make('head_id')
                            ->label('Department Head')
                            ->options(fn ($get) => match ($get('head_type')) {
                                'leader' => Leader::orderBy('name')->pluck('name', 'id'),
                                'member' => Member::orderBy('first_name')->get()
                                    ->mapWithKeys(fn ($m) => [$m->id => trim("{$m->first_name} {$m->last_name}")]),
                                default  => [],
                            })
                            ->searchable()
                            ->nullable()
                            ->placeholder('Select a person…')
                            ->visible(fn ($get) => filled($get('head_type'))),
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

