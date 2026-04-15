<?php

namespace App\Filament\Resources\MissionCountries\Pages;

use App\Filament\Resources\MissionCountries\MissionCountryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMissionCountry extends EditRecord
{
    protected static string $resource = MissionCountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
