<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TransferBarang;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransferBarangPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TransferBarang');
    }

    public function view(AuthUser $authUser, TransferBarang $transferBarang): bool
    {
        return $authUser->can('View:TransferBarang');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TransferBarang');
    }

    public function update(AuthUser $authUser, TransferBarang $transferBarang): bool
    {
        return $authUser->can('Update:TransferBarang');
    }

    public function delete(AuthUser $authUser, TransferBarang $transferBarang): bool
    {
        return $authUser->can('Delete:TransferBarang');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:TransferBarang');
    }

    public function restore(AuthUser $authUser, TransferBarang $transferBarang): bool
    {
        return $authUser->can('Restore:TransferBarang');
    }

    public function forceDelete(AuthUser $authUser, TransferBarang $transferBarang): bool
    {
        return $authUser->can('ForceDelete:TransferBarang');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TransferBarang');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TransferBarang');
    }

    public function replicate(AuthUser $authUser, TransferBarang $transferBarang): bool
    {
        return $authUser->can('Replicate:TransferBarang');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TransferBarang');
    }

}