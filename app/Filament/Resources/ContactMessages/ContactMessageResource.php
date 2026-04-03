<?php

namespace App\Filament\Resources\ContactMessages;

use App\Filament\Resources\ContactMessages\Pages\ListContactMessages;
use App\Filament\Resources\ContactMessages\Pages\ViewContactMessage;
use App\Models\ContactMessage;
use BackedEnum;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    public static function getNavigationGroup(): ?string { return 'Communication'; }
    public static function getNavigationLabel(): string  { return 'Contact Messages'; }
    public static function getNavigationSort(): ?int     { return 1; }

    public static function getNavigationBadge(): ?string
    {
        $count = ContactMessage::query()->where('is_read', false)->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                IconColumn::make('is_read')
                    ->label('')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedEnvelopeOpen)
                    ->falseIcon(Heroicon::OutlinedEnvelope)
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->width('40px'),

                TextColumn::make('name')
                    ->label('From')
                    ->searchable()
                    ->weight(fn ($record) => $record->is_read ? 'normal' : 'bold'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->color('primary'),

                TextColumn::make('enquiry_type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'general'      => 'General',
                        'prayer'       => 'Prayer',
                        'volunteering' => 'Volunteering',
                        'events'       => 'Events',
                        'bible-school' => 'Bible School',
                        'other'        => 'Other',
                        default        => $state,
                    })
                    ->color(fn (string $state) => match ($state) {
                        'prayer'       => 'success',
                        'volunteering' => 'info',
                        'events'       => 'warning',
                        'bible-school' => 'primary',
                        default        => 'gray',
                    }),

                TextColumn::make('subject')
                    ->label('Subject')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->since()
                    ->sortable(),

                TextColumn::make('replied_at')
                    ->label('Replied')
                    ->since()
                    ->placeholder('Not replied')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_read')
                    ->label('Status')
                    ->options([
                        '0' => 'Unread',
                        '1' => 'Read',
                    ]),

                Tables\Filters\SelectFilter::make('enquiry_type')
                    ->label('Enquiry Type')
                    ->options([
                        'general'      => 'General',
                        'prayer'       => 'Prayer Request',
                        'volunteering' => 'Volunteering',
                        'events'       => 'Events',
                        'bible-school' => 'Bible School',
                        'other'        => 'Other',
                    ]),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('mark_read')
                        ->label('Mark as Read')
                        ->icon(Heroicon::OutlinedEnvelopeOpen)
                        ->action(fn ($records) => $records->each->markAsRead())
                        ->deselectRecordsAfterCompletion(),

                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactMessages::route('/'),
            'view'  => ViewContactMessage::route('/{record}'),
        ];
    }
}
