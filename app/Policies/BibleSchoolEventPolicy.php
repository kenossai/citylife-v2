<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\BibleSchoolEvent;
use Illuminate\Auth\Access\HandlesAuthorization;

class BibleSchoolEventPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:BibleSchoolEvent');
    }

    public function view(AuthUser $authUser, BibleSchoolEvent $bibleSchoolEvent): bool
    {
        return $authUser->can('View:BibleSchoolEvent');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:BibleSchoolEvent');
    }

    public function update(AuthUser $authUser, BibleSchoolEvent $bibleSchoolEvent): bool
    {
        return $authUser->can('Update:BibleSchoolEvent');
    }

    public function delete(AuthUser $authUser, BibleSchoolEvent $bibleSchoolEvent): bool
    {
        return $authUser->can('Delete:BibleSchoolEvent');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:BibleSchoolEvent');
    }

    public function restore(AuthUser $authUser, BibleSchoolEvent $bibleSchoolEvent): bool
    {
        return $authUser->can('Restore:BibleSchoolEvent');
    }

    public function forceDelete(AuthUser $authUser, BibleSchoolEvent $bibleSchoolEvent): bool
    {
        return $authUser->can('ForceDelete:BibleSchoolEvent');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:BibleSchoolEvent');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:BibleSchoolEvent');
    }

    public function replicate(AuthUser $authUser, BibleSchoolEvent $bibleSchoolEvent): bool
    {
        return $authUser->can('Replicate:BibleSchoolEvent');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:BibleSchoolEvent');
    }

}