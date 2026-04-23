<?php

namespace App\Filament\Resources\Members\Pages;

use App\Filament\Resources\Members\GraduatedMembersResource;
use App\Models\Member;
use App\Services\ChurchSuiteService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

class ListGraduatedMembers extends ListRecords
{
    protected static string $resource = GraduatedMembersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('syncAllGraduated')
                ->label('Sync All to ChurchSuite')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Sync all graduated members to ChurchSuite')
                ->modalDescription('This will push every graduated member (CDC alumni with status "Member") to ChurchSuite CRM.')
                ->modalSubmitActionLabel('Yes, sync all')
                ->action(function (): void {
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

                    Member::where('membership_status', 'member')
                        ->whereHas('enrollments', function (Builder $q): void {
                            $q->where('status', 'completed')
                              ->whereHas('course', fn (Builder $c) => $c->where('is_membership_course', true));
                        })
                        ->each(function (Member $member) use ($service, &$succeeded, &$failed): void {
                            try {
                                $service->syncMember($member);
                                $succeeded++;
                            } catch (Throwable) {
                                $failed++;
                            }
                        });

                    if ($succeeded > 0) {
                        Notification::make()
                            ->title("{$succeeded} graduated member(s) synced to ChurchSuite")
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
        ];
    }
}
