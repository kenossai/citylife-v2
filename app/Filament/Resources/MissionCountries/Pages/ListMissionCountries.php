<?php

namespace App\Filament\Resources\MissionCountries\Pages;

use App\Filament\Resources\MissionCountries\MissionCountryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMissionCountries extends ListRecords
{
    protected static string $resource = MissionCountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
