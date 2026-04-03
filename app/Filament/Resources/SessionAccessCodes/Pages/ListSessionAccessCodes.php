<?php

namespace App\Filament\Resources\SessionAccessCodes\Pages;

use App\Filament\Resources\SessionAccessCodes\SessionAccessCodeResource;
use Filament\Resources\Pages\ListRecords;

class ListSessionAccessCodes extends ListRecords
{
    protected static string $resource = SessionAccessCodeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
