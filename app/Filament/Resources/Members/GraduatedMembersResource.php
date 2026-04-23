<?php

namespace App\Filament\Resources\Members;

use App\Filament\Resources\Members\Pages\EditMember;
use App\Filament\Resources\Members\Pages\ListGraduatedMembers;
use App\Filament\Resources\Members\Schemas\MemberForm;
use App\Models\Member;
use App\Services\ChurchSuiteService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use App\Models\CourseEnrollment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class GraduatedMembersResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static bool $shouldRegisterNavigation = false;

    public static function getNavigationGroup(): ?string { return 'Members'; }
    public static function getNavigationLabel(): string  { return 'Graduated Members'; }
    public static function getNavigationSort(): ?int     { return 2; }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('membership_status', 'member')
            ->whereHas('enrollments', function (Builder $q): void {
                $q->where('status', 'completed')
                  ->whereHas('course', fn (Builder $c) => $c->where('is_membership_course', true));
            });
    }

    public static function form(Schema $schema): Schema
    {
        return MemberForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('membership_number')
                    ->label('Membership #')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('full_name')
                    ->label('Name')
                    ->getStateUsing(fn (Member $record) => $record->full_name)
                    ->searchable(query: function ($query, string $search): void {
                        $query->where(function ($q) use ($search) {
                            $q->where('first_name', 'like', "%{$search}%")
                              ->orWhere('last_name', 'like', "%{$search}%");
                        });
                    })
                    ->sortable(query: fn ($query, string $direction) => $query->orderBy('last_name', $direction)),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('phone')
                    ->copyable(),
                TextColumn::make('membership_date')
                    ->label('Member Since')
                    ->date('M j, Y')
                    ->sortable(),
                TextColumn::make('cdc_course')
                    ->label('CDC Course')
                    ->getStateUsing(function (Member $record): string {
                        $enrollment = CourseEnrollment::where('member_id', $record->id)
                            ->where('status', 'completed')
                            ->whereHas('course', fn ($q) => $q->where('is_membership_course', true))
                            ->with('course')
                            ->latest('completed_at')
                            ->first();

                        return $enrollment?->course?->title ?? '—';
                    })
                    ->limit(30),
                TextColumn::make('cdc_completed_at')
                    ->label('Graduated')
                    ->getStateUsing(function (Member $record): ?string {
                        $completed = CourseEnrollment::where('member_id', $record->id)
                            ->where('status', 'completed')
                            ->whereHas('course', fn ($q) => $q->where('is_membership_course', true))
                            ->latest('completed_at')
                            ->value('completed_at');

                        return $completed ? \Illuminate\Support\Carbon::parse($completed)->format('M j, Y') : '—';
                    })
                    ->color('gray'),
                IconColumn::make('cdc_certificate')
                    ->label('Certificate')
                    ->getStateUsing(fn (Member $record) => CourseEnrollment::where('member_id', $record->id)
                        ->where('certificate_issued', true)
                        ->whereHas('course', fn ($q) => $q->where('is_membership_course', true))
                        ->exists()
                    )
                    ->boolean()
                    ->trueIcon('heroicon-m-check-badge')
                    ->falseIcon('heroicon-m-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextColumn::make('churchsuite_sync_status')
                    ->label('ChurchSuite')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'synced'  => 'success',
                        'failed'  => 'danger',
                        'pending' => 'warning',
                        default   => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state) => $state ? ucfirst($state) : 'Not synced')
                    ->sortable(),
                TextColumn::make('churchsuite_synced_at')
                    ->label('Last Synced')
                    ->since()
                    ->color('gray')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->defaultSort('last_name')
            ->filters([
                SelectFilter::make('churchsuite_sync_status')
                    ->label('Sync Status')
                    ->options([
                        'synced'  => 'Synced',
                        'failed'  => 'Failed',
                        'pending' => 'Pending',
                    ])
                    ->placeholder('All'),
            ])
            ->recordActions([
                Action::make('syncToChurchSuite')
                    ->label('Sync')
                    ->icon('heroicon-o-arrow-path')
                    ->color('gray')
                    ->iconButton()
                    ->tooltip('Sync to ChurchSuite')
                    ->requiresConfirmation()
                    ->modalHeading('Sync to ChurchSuite')
                    ->modalDescription('Push this member\'s data to ChurchSuite CRM.')
                    ->action(function (Member $record): void {
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
                \Filament\Actions\EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('syncSelectedToChurchSuite')
                        ->label('Sync to ChurchSuite')
                        ->icon('heroicon-o-arrow-path')
                        ->color('gray')
                        ->requiresConfirmation()
                        ->modalHeading('Sync selected members to ChurchSuite')
                        ->modalDescription('Push the selected graduated members to ChurchSuite CRM.')
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

                            foreach ($records as $member) {
                                try {
                                    $service->syncMember($member);
                                    $succeeded++;
                                } catch (Throwable) {
                                    $failed++;
                                }
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
            'index' => ListGraduatedMembers::route('/'),
            'edit'  => EditMember::route('/{record}/edit'),
        ];
    }
}
