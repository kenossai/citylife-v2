<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DepartmentMember;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentMemberPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:DepartmentMember');
    }

    public function view(AuthUser $authUser, DepartmentMember $departmentMember): bool
    {
        return $authUser->can('View:DepartmentMember');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:DepartmentMember');
    }

    public function update(AuthUser $authUser, DepartmentMember $departmentMember): bool
    {
        return $authUser->can('Update:DepartmentMember');
    }

    public function delete(AuthUser $authUser, DepartmentMember $departmentMember): bool
    {
        return $authUser->can('Delete:DepartmentMember');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:DepartmentMember');
    }

    public function restore(AuthUser $authUser, DepartmentMember $departmentMember): bool
    {
        return $authUser->can('Restore:DepartmentMember');
    }

    public function forceDelete(AuthUser $authUser, DepartmentMember $departmentMember): bool
    {
        return $authUser->can('ForceDelete:DepartmentMember');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:DepartmentMember');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:DepartmentMember');
    }

    public function replicate(AuthUser $authUser, DepartmentMember $departmentMember): bool
    {
        return $authUser->can('Replicate:DepartmentMember');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:DepartmentMember');
    }

}