<?php

namespace App\Filament\Resources\BibleSchoolVideos\Pages;

use App\Filament\Resources\BibleSchoolVideos\BibleSchoolVideoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBibleSchoolVideos extends ListRecords
{
    protected static string $resource = BibleSchoolVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
