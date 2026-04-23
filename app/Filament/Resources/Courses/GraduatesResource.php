<?php

namespace App\Filament\Resources\Courses;

use App\Filament\Resources\Courses\Pages\ListGraduates;
use App\Models\Graduate;
use App\Services\ChurchSuiteService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class GraduatesResource extends Resource
{
    protected static ?string $model = Graduate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    public static function getNavigationGroup(): ?string { return 'Courses'; }
    public static function getNavigationLabel(): string  { return 'Graduates'; }
    public static function getNavigationSort(): ?int     { return 5; }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('member.membership_number')
                    ->label('Membership #')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('member.full_name')
                    ->label('Name')
                    ->getStateUsing(fn (Graduate $record) => $record->member?->full_name ?? '—')
                    ->searchable(query: function ($query, string $search): void {
                        $query->whereHas('member', fn ($q) => $q
                            ->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                        );
                    })
                    ->sortable(query: fn ($query, string $direction) => $query->join('members', 'graduates.member_id', '=', 'members.id')->orderBy('members.last_name', $direction)),
                TextColumn::make('member.email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('member.phone')
                    ->label('Phone')
                    ->copyable(),
                TextColumn::make('course.title')
                    ->label('Course')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                IconColumn::make('is_membership')
                    ->label('Membership')
                    ->getStateUsing(fn (Graduate $record) => $record->course?->is_membership_course ?? false)
                    ->boolean()
                    ->trueIcon('heroicon-m-check-badge')
                    ->falseIcon('heroicon-m-minus')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->tooltip(fn (Graduate $record) => ($record->course?->is_membership_course) ? 'Membership course' : 'Regular course'),
                TextColumn::make('graduated_at')
                    ->label('Graduated')
                    ->date('M j, Y')
                    ->sortable(),
                IconColumn::make('certificate_issued')
                    ->label('Certificate')
                    ->boolean()
                    ->trueIcon('heroicon-m-check-badge')
                    ->falseIcon('heroicon-m-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextColumn::make('member.churchsuite_sync_status')
                    ->label('ChurchSuite')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'synced'  => 'success',
                        'failed'  => 'danger',
                        'pending' => 'warning',
                        default   => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state) => $state ? ucfirst($state) : 'Not synced')
                    ->sortable()
                    ->visible(fn () => app(ChurchSuiteService::class)->isConfigured()),
                TextColumn::make('member.churchsuite_synced_at')
                    ->label('Last Synced')
                    ->since()
                    ->color('gray')
                    ->sortable()
                    ->visible(fn () => app(ChurchSuiteService::class)->isConfigured()),
            ])
            ->defaultSort('graduated_at', 'desc')
            ->filters([
                SelectFilter::make('course_id')
                    ->label('Course')
                    ->relationship('course', 'title')
                    ->searchable()
                    ->placeholder('All courses'),
                SelectFilter::make('certificate_issued')
                    ->label('Certificate')
                    ->options([
                        '1' => 'Issued',
                        '0' => 'Not issued',
                    ])
                    ->placeholder('All'),
            ])
            ->recordActions([
                Action::make('syncToChurchSuite')
                    ->icon('heroicon-o-arrow-path')
                    ->color('primary')
                    ->iconButton()
                    ->tooltip('Sync to ChurchSuite')
                    ->requiresConfirmation()
                    ->modalHeading('Sync to ChurchSuite')
                    ->modalDescription('Push this graduate\'s member record to ChurchSuite CRM.')
                    ->visible(fn (Graduate $record) => $record->course?->is_membership_course)
                    ->action(function (Graduate $record): void {
                        if (! $record->member) {
                            return;
                        }

                        $service = app(ChurchSuiteService::class);

                        if (! $service->isConfigured()) {
                            Notification::make()
                                ->title('ChurchSuite not configured')
                                ->body('Set CHURCHSUITE_CLIENT_ID and CHURCHSUITE_CLIENT_SECRET in your environment.')
                                ->danger()
                                ->send();
                            return;
                        }

                        try {
                            $service->syncMember($record->member);
                            Notification::make()->title('Synced to ChurchSuite')->success()->send();
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
                    BulkAction::make('syncSelectedToChurchSuite')
                        ->label('Sync to ChurchSuite')
                        ->icon('heroicon-o-arrow-path')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->modalHeading('Sync selected graduates to ChurchSuite')
                        ->modalDescription('Only graduates from a membership course will be synced. Others will be skipped.')
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

                            $succeeded = 0;
                            $failed    = 0;
                            $skipped   = 0;

                            foreach ($records as $graduate) {
                                if (! $graduate->course?->is_membership_course) {
                                    $skipped++;
                                    continue;
                                }

                                if (! $graduate->member) {
                                    $skipped++;
                                    continue;
                                }

                                try {
                                    $service->syncMember($graduate->member);
                                    $succeeded++;
                                } catch (Throwable) {
                                    $failed++;
                                }
                            }

                            if ($succeeded > 0) {
                                Notification::make()
                                    ->title("{$succeeded} graduate(s) synced to ChurchSuite")
                                    ->success()
                                    ->send();
                            }
                            if ($skipped > 0) {
                                Notification::make()
                                    ->title("{$skipped} record(s) skipped (not from a membership course)")
                                    ->warning()
                                    ->send();
                            }
                            if ($failed > 0) {
                                Notification::make()
                                    ->title("{$failed} graduate(s) failed to sync")
                                    ->body('Open each failed record to see the error.')
                                    ->danger()
                                    ->persistent()
                                    ->send();
                            }
                        }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGraduates::route('/'),
        ];
    }
}
