<?php

namespace App\Filament\Resources\DepartmentMembers\Tables;

use App\Models\Member;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DepartmentMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('member.first_name')
                    ->label('Member')
                    ->formatStateUsing(fn ($state, $record) => trim("{$record->member->first_name} {$record->member->last_name}"))
                    ->searchable(['members.first_name', 'members.last_name'])
                    ->sortable(),
                TextColumn::make('member.membership_number')
                    ->label('Membership No.')
                    ->sortable(),
                TextColumn::make('role')
                    ->label('Role')
                    ->placeholder('—'),
                TextColumn::make('created_at')
                    ->label('Assigned')
                    ->date('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('department_id')
                    ->label('Department')
                    ->relationship('department', 'name'),
            ])
            ->defaultSort('department.name')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
