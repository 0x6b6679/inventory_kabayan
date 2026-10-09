<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\StokGudang;
use Illuminate\Auth\Access\HandlesAuthorization;

class StokGudangPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:StokGudang');
    }

    public function view(AuthUser $authUser, StokGudang $stokGudang): bool
    {
        return $authUser->can('View:StokGudang');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:StokGudang');
    }

    public function update(AuthUser $authUser, StokGudang $stokGudang): bool
    {
        return $authUser->can('Update:StokGudang');
    }

    public function delete(AuthUser $authUser, StokGudang $stokGudang): bool
    {
        return $authUser->can('Delete:StokGudang');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:StokGudang');
    }

    public function restore(AuthUser $authUser, StokGudang $stokGudang): bool
    {
        return $authUser->can('Restore:StokGudang');
    }

    public function forceDelete(AuthUser $authUser, StokGudang $stokGudang): bool
    {
        return $authUser->can('ForceDelete:StokGudang');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:StokGudang');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:StokGudang');
    }

    public function replicate(AuthUser $authUser, StokGudang $stokGudang): bool
    {
        return $authUser->can('Replicate:StokGudang');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:StokGudang');
    }

}