<?php

namespace App\Filament\Resources\Members\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Name')
                    ->getStateUsing(fn ($record) => $record->full_name)
                    ->searchable(query: function ($query, string $search): void {
                        $query->where(function ($q) use ($search) {
                            $q->where('first_name', 'like', "%{$search}%")
                              ->orWhere('last_name', 'like', "%{$search}%");
                        });
                    })
                    ->sortable(query: fn ($query, string $direction) => $query->orderBy('last_name', $direction)),
                TextColumn::make('email')->searchable(),
                TextColumn::make('phone'),
                TextColumn::make('membership_status')->label('Status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'member'      => 'success',
                        'visitor'     => 'info',
                        'new_convert' => 'warning',
                        'inactive'    => 'gray',
                        'transferred' => 'warning',
                        'deceased'    => 'danger',
                        default       => 'gray',
                    }),
                TextColumn::make('first_visit_date')->label('First Visit')->date('M j, Y')->sortable(),
                IconColumn::make('is_active')->label('Active')->boolean(),
            ])
            ->filters([
                SelectFilter::make('membership_status')
                    ->options([
                        'visitor'     => 'Visitor',
                        'new_convert' => 'New Convert',
                        'member'      => 'Member',
                        'inactive'    => 'Inactive',
                        'transferred' => 'Transferred',
                        'deceased'    => 'Deceased',
                    ]),
            ])
            ->defaultSort('last_name')
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
