<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\BibleSchoolMedia;
use Illuminate\Auth\Access\HandlesAuthorization;

class BibleSchoolMediaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:BibleSchoolMedia');
    }

    public function view(AuthUser $authUser, BibleSchoolMedia $bibleSchoolMedia): bool
    {
        return $authUser->can('View:BibleSchoolMedia');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:BibleSchoolMedia');
    }

    public function update(AuthUser $authUser, BibleSchoolMedia $bibleSchoolMedia): bool
    {
        return $authUser->can('Update:BibleSchoolMedia');
    }

    public function delete(AuthUser $authUser, BibleSchoolMedia $bibleSchoolMedia): bool
    {
        return $authUser->can('Delete:BibleSchoolMedia');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:BibleSchoolMedia');
    }

    public function restore(AuthUser $authUser, BibleSchoolMedia $bibleSchoolMedia): bool
    {
        return $authUser->can('Restore:BibleSchoolMedia');
    }

    public function forceDelete(AuthUser $authUser, BibleSchoolMedia $bibleSchoolMedia): bool
    {
        return $authUser->can('ForceDelete:BibleSchoolMedia');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:BibleSchoolMedia');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:BibleSchoolMedia');
    }

    public function replicate(AuthUser $authUser, BibleSchoolMedia $bibleSchoolMedia): bool
    {
        return $authUser->can('Replicate:BibleSchoolMedia');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:BibleSchoolMedia');
    }

}