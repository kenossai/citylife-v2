<?php

namespace App\Filament\Resources\DepartmentMembers\Pages;

use App\Filament\Resources\DepartmentMembers\DepartmentMemberResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDepartmentMember extends EditRecord
{
    protected static string $resource = DepartmentMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
