<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SessionAccessCode;
use Illuminate\Auth\Access\HandlesAuthorization;

class SessionAccessCodePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SessionAccessCode');
    }

    public function view(AuthUser $authUser, SessionAccessCode $sessionAccessCode): bool
    {
        return $authUser->can('View:SessionAccessCode');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SessionAccessCode');
    }

    public function update(AuthUser $authUser, SessionAccessCode $sessionAccessCode): bool
    {
        return $authUser->can('Update:SessionAccessCode');
    }

    public function delete(AuthUser $authUser, SessionAccessCode $sessionAccessCode): bool
    {
        return $authUser->can('Delete:SessionAccessCode');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:SessionAccessCode');
    }

    public function restore(AuthUser $authUser, SessionAccessCode $sessionAccessCode): bool
    {
        return $authUser->can('Restore:SessionAccessCode');
    }

    public function forceDelete(AuthUser $authUser, SessionAccessCode $sessionAccessCode): bool
    {
        return $authUser->can('ForceDelete:SessionAccessCode');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SessionAccessCode');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SessionAccessCode');
    }

    public function replicate(AuthUser $authUser, SessionAccessCode $sessionAccessCode): bool
    {
        return $authUser->can('Replicate:SessionAccessCode');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SessionAccessCode');
    }

}