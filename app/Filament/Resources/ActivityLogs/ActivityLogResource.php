<?php

namespace App\Filament\Resources\ActivityLogs;

use App\Filament\Resources\ActivityLogs\Pages\ListActivityLogs;
use App\Filament\Resources\ActivityLogs\Pages\ViewActivityLog;
use App\Models\ActivityLog;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section as InfoSection;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function getNavigationGroup(): ?string { return 'Administration'; }
    public static function getNavigationLabel(): string  { return 'Audit Trails'; }
    public static function getModelLabel(): string       { return 'Audit Trail'; }
    public static function getPluralModelLabel(): string { return 'Audit Trails'; }
    public static function getNavigationSort(): ?int     { return 10; }

    public static function canCreate(): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Timestamp')
                    ->since()
                    ->sortable()
                    ->tooltip(fn (ActivityLog $record) => $record->created_at->format('j M Y, H:i:s')),

                TextColumn::make('causer_label')
                    ->label('User')
                    ->getStateUsing(fn (ActivityLog $record) => $record->causer_label)
                    ->searchable(query: function ($query, string $search) {
                        $query->whereHasMorph('causer', ['App\Models\User', 'App\Models\Member'], function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%")
                              ->orWhere('email', 'like', "%{$search}%")
                              ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
                        });
                    }),

                TextColumn::make('event')
                    ->label('Action')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'created'    => 'success',
                        'updated'    => 'warning',
                        'deleted'    => 'danger',
                        'logged_in'  => 'success',
                        'logged_out' => 'gray',
                        default      => 'gray',
                    })
                    ->formatStateUsing(fn (ActivityLog $record) => $record->action_label),

                TextColumn::make('resource_type')
                    ->label('Resource')
                    ->getStateUsing(fn (ActivityLog $record) => $record->resource_type),

                TextColumn::make('subject_label')
                    ->label('Item')
                    ->getStateUsing(fn (ActivityLog $record) => $record->subject_label)
                    ->limit(35),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Authentication'     => 'info',
                        'Personal Information' => 'warning',
                        'Content Management' => 'gray',
                        'Courses'            => 'success',
                        default              => 'gray',
                    }),

                TextColumn::make('severity')
                    ->label('Severity')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'high'   => 'danger',
                        'medium' => 'warning',
                        'low'    => 'success',
                        default  => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state) => ucfirst($state ?? 'low')),

                IconColumn::make('is_sensitive')
                    ->label('Sensitive')
                    ->icon(fn (bool $state): string => $state
                        ? 'heroicon-o-exclamation-triangle'
                        : 'heroicon-o-x-circle')
                    ->color(fn (bool $state): string => $state ? 'warning' : 'danger'),
            ])
            ->filters([
                SelectFilter::make('event')
                    ->label('Action')
                    ->options([
                        'logged_in'  => 'Logged In',
                        'logged_out' => 'Logged Out',
                        'created'    => 'Created',
                        'updated'    => 'Updated',
                        'deleted'    => 'Deleted',
                    ]),
                SelectFilter::make('category')
                    ->label('Category')
                    ->options([
                        'Authentication'       => 'Authentication',
                        'Personal Information' => 'Personal Information',
                        'Content Management'   => 'Content Management',
                        'Courses'              => 'Courses',
                    ]),
                SelectFilter::make('severity')
                    ->label('Severity')
                    ->options([
                        'low'    => 'Low',
                        'medium' => 'Medium',
                        'high'   => 'High',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordUrl(null)
            ->recordActions([
                Action::make('view_details')
                    ->label('View Details')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Audit Trail Details')
                    ->modalWidth('5xl')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->schema(fn (ActivityLog $record): array => [
                        Grid::make(2)
                            ->schema([
                                InfoSection::make('Event Details')
                                    ->schema([
                                        TextEntry::make('timestamp')
                                            ->label('Timestamp')
                                            ->state(fn () => $record->created_at->format('M j, Y \a\t g:i:s A')),
                                        TextEntry::make('action')
                                            ->label('Action')
                                            ->badge()
                                            ->state(fn () => $record->action_label)
                                            ->color(fn () => match ($record->event) {
                                                'created', 'logged_in' => 'success',
                                                'updated'              => 'warning',
                                                'deleted'              => 'danger',
                                                'logged_out'           => 'gray',
                                                default                => 'gray',
                                            }),
                                        TextEntry::make('resource')
                                            ->label('Resource')
                                            ->state(fn () => $record->resource_type),
                                        TextEntry::make('item')
                                            ->label('Item')
                                            ->state(fn () => $record->subject_label),
                                    ]),

                                InfoSection::make('User & Context')
                                    ->schema([
                                        TextEntry::make('user')
                                            ->label('User')
                                            ->state(fn () => $record->causer_label),
                                        TextEntry::make('guard')
                                            ->label('Guard / Portal')
                                            ->state(fn () => match ($record->properties['guard'] ?? null) {
                                                'web'    => 'Admin (web)',
                                                'member' => 'Member Portal',
                                                null     => '—',
                                                default  => $record->properties['guard'],
                                            })
                                            ->badge()
                                            ->color(fn () => match ($record->properties['guard'] ?? null) {
                                                'web'    => 'info',
                                                'member' => 'success',
                                                default  => 'gray',
                                            })
                                            ->visible(fn () => filled($record->properties['guard'] ?? null)),
                                        TextEntry::make('ip_address')
                                            ->label('IP Address')
                                            ->state(fn () => $record->properties['context']['ip_address'] ?? '—'),
                                        TextEntry::make('category')
                                            ->label('Category')
                                            ->badge()
                                            ->state(fn () => $record->category ?? '—')
                                            ->color(fn () => match ($record->category) {
                                                'Authentication'       => 'info',
                                                'Personal Information' => 'warning',
                                                'Content Management'   => 'gray',
                                                'Courses'              => 'success',
                                                default                => 'gray',
                                            }),
                                        TextEntry::make('severity')
                                            ->label('Severity')
                                            ->badge()
                                            ->state(fn () => ucfirst($record->severity ?? 'low'))
                                            ->color(fn () => match ($record->severity) {
                                                'high'   => 'danger',
                                                'medium' => 'warning',
                                                default  => 'success',
                                            }),
                                    ]),
                            ]),

                        InfoSection::make('Description')
                            ->schema([
                                TextEntry::make('description')
                                    ->label('')
                                    ->state(fn () => $record->description ?? '—'),
                            ])
                            ->visible(fn () => filled($record->description)),

                        InfoSection::make('Additional Context')
                            ->schema([
                                TextEntry::make('context_data')
                                    ->label('')
                                    ->state(function () use ($record) {
                                        $props = $record->properties->except(['context', 'attributes', 'old'])->toArray();
                                        return filled($props) ? json_encode($props, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '—';
                                    })
                                    ->fontFamily('mono')
                                    ->copyable(),
                            ])
                            ->visible(fn () => $record->properties->except(['context', 'attributes', 'old'])->isNotEmpty()),

                        InfoSection::make('Technical Details')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('url')
                                    ->label('URL')
                                    ->state(fn () => $record->properties['context']['url'] ?? '—')
                                    ->columnSpanFull(),
                                TextEntry::make('method')
                                    ->label('HTTP Method')
                                    ->state(fn () => $record->properties['context']['method'] ?? '—'),
                                TextEntry::make('user_agent')
                                    ->label('User Agent')
                                    ->state(fn () => $record->properties['context']['user_agent'] ?? '—')
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivityLogs::route('/'),
            'view'  => ViewActivityLog::route('/{record}'),
        ];
    }
}
