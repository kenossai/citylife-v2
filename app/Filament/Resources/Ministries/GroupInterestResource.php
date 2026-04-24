<?php

namespace App\Filament\Resources\Ministries;

use App\Filament\Resources\Ministries\Pages\ListGroupInterests;
use App\Mail\GroupInterestReadMail;
use App\Models\MinistryEnquiry;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class GroupInterestResource extends Resource
{
    protected static ?string $model = MinistryEnquiry::class;

    protected static ?string $slug = 'group-interests';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    public static function getNavigationGroup(): ?string { return 'Courses'; }
    public static function getNavigationLabel(): string  { return 'Group Interests'; }
    public static function getNavigationSort(): ?int     { return 4; }

    public static function canCreate(): bool { return false; }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('M j, Y g:i A')
                    ->sortable(),

                TextColumn::make('ministry.name')
                    ->label('Life Group')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('warning'),

                TextColumn::make('full_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->copyable()
                    ->placeholder('—'),

                TextColumn::make('message')
                    ->label('Message')
                    ->limit(60)
                    ->placeholder('—')
                    ->wrap(),

                IconColumn::make('is_read')
                    ->label('Read')
                    ->boolean()
                    ->trueIcon('heroicon-m-check-circle')
                    ->falseIcon('heroicon-m-envelope')
                    ->trueColor('success')
                    ->falseColor('warning'),
            ])
            ->filters([
                SelectFilter::make('ministry_id')
                    ->label('Life Group')
                    ->relationship('ministry', 'name')
                    ->searchable()
                    ->placeholder('All groups'),

                TernaryFilter::make('is_read')
                    ->label('Read Status')
                    ->trueLabel('Read')
                    ->falseLabel('Unread'),
            ])
            ->recordActions([
                Action::make('markRead')
                    ->label('Mark as Read')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->iconButton()
                    ->tooltip('Mark as read & notify enquirer')
                    ->visible(fn (MinistryEnquiry $record) => ! $record->is_read)
                    ->action(function (MinistryEnquiry $record) {
                        $record->update(['is_read' => true]);
                        Mail::to($record->email)->send(new GroupInterestReadMail($record));
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGroupInterests::route('/'),
        ];
    }
}
