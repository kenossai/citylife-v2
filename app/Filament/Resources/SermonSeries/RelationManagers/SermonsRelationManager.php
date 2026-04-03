<?php

namespace App\Filament\Resources\SermonSeries\RelationManagers;

use App\Models\Leader;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SermonsRelationManager extends RelationManager
{
    protected static string $relationship = 'sermons';

    protected static ?string $title = 'Sermons in this Series';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(150)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->required()
                    ->unique(\App\Models\Sermon::class, ignoreRecord: true)
                    ->maxLength(200)
                    ->columnSpanFull(),
                Select::make('leader_id')
                    ->label('Pastor / Speaker')
                    ->options(fn () => Leader::orderBy('name')->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
                TextInput::make('guest_speaker_name')
                    ->label('Guest Speaker')
                    ->maxLength(150)
                    ->nullable(),
                TextInput::make('scripture')->maxLength(100),
                DatePicker::make('preached_at')->label('Date Preached')->required(),
                TextInput::make('service_label')->maxLength(100),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('preached_at')->label('Date')->date('M j, Y')->sortable(),
                TextColumn::make('title')->searchable()->limit(50),
                TextColumn::make('speaker_name')
                    ->label('Speaker')
                    ->getStateUsing(fn ($record) => $record->speaker_name),
                IconColumn::make('is_active')->label('Active')->boolean(),
            ])
            ->defaultSort('preached_at', 'desc')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
