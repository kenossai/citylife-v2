<?php

namespace App\Filament\Resources\Courses\Pages;

use App\Filament\Resources\Courses\GraduatesResource;
use App\Models\Graduate;
use App\Services\ChurchSuiteService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Throwable;

class ListGraduates extends ListRecords
{
    protected static string $resource = GraduatesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('syncMembershipGraduates')
                ->label('Sync to ChurchSuite')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Sync membership to ChurchSuite')
                ->modalDescription('This will push every graduate from a membership course to ChurchSuite CRM. Graduates from other courses will be skipped.')
                ->modalSubmitActionLabel('Yes, sync graduates')
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

                    Graduate::whereHas('course', fn ($q) => $q->where('is_membership_course', true))
                        ->with(['member', 'course'])
                        ->each(function (Graduate $graduate) use ($service, &$succeeded, &$failed): void {
                            if (! $graduate->member) {
                                return;
                            }

                            try {
                                $service->syncMember($graduate->member);
                                $succeeded++;
                            } catch (Throwable) {
                                $failed++;
                            }
                        });

                    if ($succeeded > 0) {
                        Notification::make()
                            ->title("{$succeeded} Synced successfully to ChurchSuite")
                            ->success()
                            ->send();
                    }

                    if ($failed > 0) {
                        Notification::make()
                            ->title("{$failed} Failed to sync to ChurchSuite")
                            ->body('Check each failed record for details.')
                            ->danger()
                            ->persistent()
                            ->send();
                    }
                }),
        ];
    }
}
