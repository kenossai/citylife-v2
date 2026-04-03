<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WorshipCentre;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorshipCentrePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:WorshipCentre');
    }

    public function view(AuthUser $authUser, WorshipCentre $worshipCentre): bool
    {
        return $authUser->can('View:WorshipCentre');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:WorshipCentre');
    }

    public function update(AuthUser $authUser, WorshipCentre $worshipCentre): bool
    {
        return $authUser->can('Update:WorshipCentre');
    }

    public function delete(AuthUser $authUser, WorshipCentre $worshipCentre): bool
    {
        return $authUser->can('Delete:WorshipCentre');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:WorshipCentre');
    }

    public function restore(AuthUser $authUser, WorshipCentre $worshipCentre): bool
    {
        return $authUser->can('Restore:WorshipCentre');
    }

    public function forceDelete(AuthUser $authUser, WorshipCentre $worshipCentre): bool
    {
        return $authUser->can('ForceDelete:WorshipCentre');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:WorshipCentre');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:WorshipCentre');
    }

    public function replicate(AuthUser $authUser, WorshipCentre $worshipCentre): bool
    {
        return $authUser->can('Replicate:WorshipCentre');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:WorshipCentre');
    }

}