<?php

namespace App\Filament\Resources\DepartmentMembers\Pages;

use App\Filament\Resources\DepartmentMembers\DepartmentMemberResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDepartmentMembers extends ListRecords
{
    protected static string $resource = DepartmentMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
