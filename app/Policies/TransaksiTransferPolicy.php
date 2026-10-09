<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TransaksiTransfer;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransaksiTransferPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TransaksiTransfer');
    }

    public function view(AuthUser $authUser, TransaksiTransfer $transaksiTransfer): bool
    {
        return $authUser->can('View:TransaksiTransfer');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TransaksiTransfer');
    }

    public function update(AuthUser $authUser, TransaksiTransfer $transaksiTransfer): bool
    {
        return $authUser->can('Update:TransaksiTransfer');
    }

    public function delete(AuthUser $authUser, TransaksiTransfer $transaksiTransfer): bool
    {
        return $authUser->can('Delete:TransaksiTransfer');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:TransaksiTransfer');
    }

    public function restore(AuthUser $authUser, TransaksiTransfer $transaksiTransfer): bool
    {
        return $authUser->can('Restore:TransaksiTransfer');
    }

    public function forceDelete(AuthUser $authUser, TransaksiTransfer $transaksiTransfer): bool
    {
        return $authUser->can('ForceDelete:TransaksiTransfer');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TransaksiTransfer');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TransaksiTransfer');
    }

    public function replicate(AuthUser $authUser, TransaksiTransfer $transaksiTransfer): bool
    {
        return $authUser->can('Replicate:TransaksiTransfer');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TransaksiTransfer');
    }

}