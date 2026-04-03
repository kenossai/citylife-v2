<?php

namespace App\Filament\Resources\Departments\RelationManagers;

use App\Models\Member;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';

    protected static ?string $title = 'Members';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('role')
                    ->label('Role in Department')
                    ->maxLength(100)
                    ->placeholder('e.g. Coordinator')
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('membership_number')->label('No.')->sortable(),
                TextColumn::make('full_name')
                    ->label('Name')
                    ->getStateUsing(fn (Member $record) => trim("{$record->first_name} {$record->last_name}"))
                    ->searchable(['first_name', 'last_name']),
                TextColumn::make('email')->searchable(),
                TextColumn::make('phone'),
                TextColumn::make('pivot.role')->label('Role'),
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectOptionsQuery(fn ($query) => $query->orderBy('first_name'))
                    ->recordTitle(fn (Member $record) => trim("{$record->first_name} {$record->last_name}") . " ({$record->membership_number})")
                    ->form(fn (AttachAction $action) => [
                        $action->getRecordSelect(),
                        TextInput::make('role')
                            ->label('Role in Department')
                            ->maxLength(100)
                            ->placeholder('e.g. Coordinator')
                            ->nullable(),
                    ]),
            ])
            ->recordActions([
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
