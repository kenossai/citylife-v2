<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\BibleSchoolSession;
use Illuminate\Auth\Access\HandlesAuthorization;

class BibleSchoolSessionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:BibleSchoolSession');
    }

    public function view(AuthUser $authUser, BibleSchoolSession $bibleSchoolSession): bool
    {
        return $authUser->can('View:BibleSchoolSession');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:BibleSchoolSession');
    }

    public function update(AuthUser $authUser, BibleSchoolSession $bibleSchoolSession): bool
    {
        return $authUser->can('Update:BibleSchoolSession');
    }

    public function delete(AuthUser $authUser, BibleSchoolSession $bibleSchoolSession): bool
    {
        return $authUser->can('Delete:BibleSchoolSession');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:BibleSchoolSession');
    }

    public function restore(AuthUser $authUser, BibleSchoolSession $bibleSchoolSession): bool
    {
        return $authUser->can('Restore:BibleSchoolSession');
    }

    public function forceDelete(AuthUser $authUser, BibleSchoolSession $bibleSchoolSession): bool
    {
        return $authUser->can('ForceDelete:BibleSchoolSession');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:BibleSchoolSession');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:BibleSchoolSession');
    }

    public function replicate(AuthUser $authUser, BibleSchoolSession $bibleSchoolSession): bool
    {
        return $authUser->can('Replicate:BibleSchoolSession');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:BibleSchoolSession');
    }

}