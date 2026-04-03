<?php

namespace App\Filament\Resources\BibleSchoolAudios\Pages;

use App\Filament\Resources\BibleSchoolAudios\BibleSchoolAudioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBibleSchoolAudios extends ListRecords
{
    protected static string $resource = BibleSchoolAudioResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
