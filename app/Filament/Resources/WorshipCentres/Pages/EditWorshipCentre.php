<?php

namespace App\Filament\Resources\WorshipCentres\Pages;

use App\Filament\Resources\WorshipCentres\WorshipCentreResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWorshipCentre extends EditRecord
{
    protected static string $resource = WorshipCentreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
