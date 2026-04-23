<?php

namespace App\Filament\Resources\Members\Tables;

use App\Services\ChurchSuiteService;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

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
                TextColumn::make('churchsuite_sync_status')
                    ->label('ChurchSuite')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'synced'  => 'success',
                        'failed'  => 'danger',
                        'pending' => 'warning',
                        default   => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state) => $state ? ucfirst($state) : '—'),
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
                SelectFilter::make('churchsuite_sync_status')
                    ->label('ChurchSuite Status')
                    ->options([
                        'synced'  => 'Synced',
                        'failed'  => 'Failed',
                        'pending' => 'Pending',
                    ]),
            ])
            ->defaultSort('last_name')
            ->recordActions([
                EditAction::make(),
                \Filament\Actions\Action::make('syncToChurchSuite')
                    ->label('Sync to ChurchSuite')
                    ->icon('heroicon-o-arrow-path')
                    ->color('gray')
                    ->iconButton()
                    ->tooltip('Sync to ChurchSuite')
                    ->requiresConfirmation()
                    ->modalHeading('Sync to ChurchSuite')
                    ->modalDescription('Push this member\'s data to ChurchSuite CRM.')
                    ->action(function ($record): void {
                        $service = app(ChurchSuiteService::class);

                        if (! $service->isConfigured()) {
                            Notification::make()
                                ->title('ChurchSuite not configured')
                                ->body('Set CHURCHSUITE_CLIENT_ID and CHURCHSUITE_CLIENT_SECRET in your environment.')
                                ->danger()
                                ->send();
                            return;
                        }

                        if ($record->membership_status !== 'member') {
                            Notification::make()
                                ->title('Cannot sync — not a full member')
                                ->body('Only CDC graduates with a status of \'Member\' can be synced to ChurchSuite.')
                                ->warning()
                                ->send();
                            return;
                        }

                        try {
                            $service->syncMember($record);
                            Notification::make()
                                ->title('Synced to ChurchSuite')
                                ->success()
                                ->send();
                        } catch (Throwable $e) {
                            Notification::make()
                                ->title('Sync failed')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('syncToChurchSuite')
                        ->label('Sync to ChurchSuite')
                        ->icon('heroicon-o-arrow-path')
                        ->color('gray')
                        ->requiresConfirmation()
                        ->action(function (Collection $records): void {
                            $service = app(ChurchSuiteService::class);

                            if (! $service->isConfigured()) {
                                Notification::make()
                                    ->title('ChurchSuite not configured')
                                    ->body('Set CHURCHSUITE_CLIENT_ID and CHURCHSUITE_CLIENT_SECRET in your environment.')
                                    ->danger()
                                    ->send();
                                return;
                            }

                            $eligible = $records->where('membership_status', 'member');
                            $skipped  = $records->count() - $eligible->count();
                            $succeeded = 0;
                            $failed    = 0;

                            foreach ($eligible as $member) {
                                try {
                                    $service->syncMember($member);
                                    $succeeded++;
                                } catch (Throwable) {
                                    $failed++;
                                }
                            }

                            if ($skipped > 0) {
                                Notification::make()
                                    ->title("{$skipped} record(s) skipped")
                                    ->body('Only CDC graduates with a status of \'Member\' are synced to ChurchSuite.')
                                    ->warning()
                                    ->send();
                            }

                            if ($succeeded > 0) {
                                Notification::make()
                                    ->title("{$succeeded} member(s) synced to ChurchSuite")
                                    ->success()
                                    ->send();
                            }
                            if ($failed > 0) {
                                Notification::make()
                                    ->title("{$failed} member(s) failed to sync")
                                    ->body('Check each member record for the error details.')
                                    ->danger()
                                    ->send();
                            }
                        }),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
