<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SermonSeries;
use Illuminate\Auth\Access\HandlesAuthorization;

class SermonSeriesPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SermonSeries');
    }

    public function view(AuthUser $authUser, SermonSeries $sermonSeries): bool
    {
        return $authUser->can('View:SermonSeries');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SermonSeries');
    }

    public function update(AuthUser $authUser, SermonSeries $sermonSeries): bool
    {
        return $authUser->can('Update:SermonSeries');
    }

    public function delete(AuthUser $authUser, SermonSeries $sermonSeries): bool
    {
        return $authUser->can('Delete:SermonSeries');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:SermonSeries');
    }

    public function restore(AuthUser $authUser, SermonSeries $sermonSeries): bool
    {
        return $authUser->can('Restore:SermonSeries');
    }

    public function forceDelete(AuthUser $authUser, SermonSeries $sermonSeries): bool
    {
        return $authUser->can('ForceDelete:SermonSeries');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SermonSeries');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SermonSeries');
    }

    public function replicate(AuthUser $authUser, SermonSeries $sermonSeries): bool
    {
        return $authUser->can('Replicate:SermonSeries');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SermonSeries');
    }

}