<?php

namespace App\Filament\Resources\Sermons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SermonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable()->limit(50),
                TextColumn::make('speaker_name')
                    ->label('Speaker')
                    ->getStateUsing(fn ($record) => $record->speaker_name)
                    ->searchable(query: function ($query, string $search): void {
                        $query->where(function ($q) use ($search) {
                            $q->where('guest_speaker_name', 'like', "%{$search}%")
                              ->orWhereHas('leader', fn ($q) => $q->where('name', 'like', "%{$search}%"));
                        });
                    }),
                TextColumn::make('series.title')->label('Series')->limit(30)->placeholder('—'),
                TextColumn::make('preached_at')->label('Date')->date('M j, Y')->sortable(),
                TextColumn::make('service_label')->label('Service')->limit(30),
                IconColumn::make('is_featured')->label('Featured')->boolean(),
                IconColumn::make('is_active')->label('Active')->boolean(),
            ])
            ->filters([])
            ->defaultSort('preached_at', 'desc')
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
