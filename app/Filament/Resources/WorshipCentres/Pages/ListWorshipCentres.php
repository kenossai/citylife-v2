<?php

namespace App\Filament\Resources\WorshipCentres\Pages;

use App\Filament\Resources\WorshipCentres\WorshipCentreResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorshipCentres extends ListRecords
{
    protected static string $resource = WorshipCentreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
