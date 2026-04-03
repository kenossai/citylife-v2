<?php

namespace App\Filament\Resources\BibleSchoolEvents\Pages;

use App\Filament\Resources\BibleSchoolEvents\BibleSchoolEventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBibleSchoolEvents extends ListRecords
{
    protected static string $resource = BibleSchoolEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
