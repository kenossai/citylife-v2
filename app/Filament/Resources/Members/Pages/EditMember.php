<?php

namespace App\Filament\Resources\Members\Pages;

use App\Filament\Resources\Members\MemberResource;
use App\Services\ChurchSuiteService;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Throwable;

class EditMember extends EditRecord
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('syncToChurchSuite')
                ->label('Sync to ChurchSuite')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->visible(fn () => app(ChurchSuiteService::class)->isConfigured())
                ->requiresConfirmation()
                ->modalHeading('Sync member to ChurchSuite')
                ->modalDescription('This will push this member\'s current data to ChurchSuite CRM. Continue?')
                ->action(function () {
                    try {
                        app(ChurchSuiteService::class)->syncMember($this->record);

                        Notification::make()
                            ->title('Synced to ChurchSuite')
                            ->body('Member data was successfully pushed to ChurchSuite.')
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
            DeleteAction::make(),
        ];
    }
}
