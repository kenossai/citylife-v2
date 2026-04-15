<?php

namespace App\Filament\Resources\MissionPillars\Pages;

use App\Filament\Resources\MissionPillars\MissionPillarResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMissionPillar extends EditRecord
{
    protected static string $resource = MissionPillarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
