<?php

namespace App\Filament\Resources\BibleSchoolSessions\Pages;

use App\Filament\Resources\BibleSchoolSessions\BibleSchoolSessionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBibleSchoolSession extends EditRecord
{
    protected static string $resource = BibleSchoolSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
