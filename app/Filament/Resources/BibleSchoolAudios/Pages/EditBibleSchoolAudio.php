<?php

namespace App\Filament\Resources\BibleSchoolAudios\Pages;

use App\Filament\Resources\BibleSchoolAudios\BibleSchoolAudioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBibleSchoolAudio extends EditRecord
{
    protected static string $resource = BibleSchoolAudioResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
