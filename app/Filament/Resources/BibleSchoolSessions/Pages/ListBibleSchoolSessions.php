<?php

namespace App\Filament\Resources\BibleSchoolSessions\Pages;

use App\Filament\Resources\BibleSchoolSessions\BibleSchoolSessionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBibleSchoolSessions extends ListRecords
{
    protected static string $resource = BibleSchoolSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
