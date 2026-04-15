<?php

namespace App\Filament\Resources\MissionPillars\Pages;

use App\Filament\Resources\MissionPillars\MissionPillarResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMissionPillars extends ListRecords
{
    protected static string $resource = MissionPillarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
