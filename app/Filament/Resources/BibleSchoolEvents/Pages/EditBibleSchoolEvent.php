<?php

namespace App\Filament\Resources\BibleSchoolEvents\Pages;

use App\Filament\Resources\BibleSchoolEvents\BibleSchoolEventResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBibleSchoolEvent extends EditRecord
{
    protected static string $resource = BibleSchoolEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
