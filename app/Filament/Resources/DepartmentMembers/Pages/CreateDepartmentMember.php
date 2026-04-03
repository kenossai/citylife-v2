<?php

namespace App\Filament\Resources\DepartmentMembers\Pages;

use App\Filament\Resources\DepartmentMembers\DepartmentMemberResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDepartmentMember extends CreateRecord
{
    protected static string $resource = DepartmentMemberResource::class;
}
