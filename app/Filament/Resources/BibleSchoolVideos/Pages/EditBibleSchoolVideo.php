<?php

namespace App\Filament\Resources\BibleSchoolVideos\Pages;

use App\Filament\Resources\BibleSchoolVideos\BibleSchoolVideoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBibleSchoolVideo extends EditRecord
{
    protected static string $resource = BibleSchoolVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
