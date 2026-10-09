<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TransaksiBarangMasuk;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransaksiBarangMasukPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TransaksiBarangMasuk');
    }

    public function view(AuthUser $authUser, TransaksiBarangMasuk $transaksiBarangMasuk): bool
    {
        return $authUser->can('View:TransaksiBarangMasuk');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TransaksiBarangMasuk');
    }

    public function update(AuthUser $authUser, TransaksiBarangMasuk $transaksiBarangMasuk): bool
    {
        return $authUser->can('Update:TransaksiBarangMasuk');
    }

    public function delete(AuthUser $authUser, TransaksiBarangMasuk $transaksiBarangMasuk): bool
    {
        return $authUser->can('Delete:TransaksiBarangMasuk');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:TransaksiBarangMasuk');
    }

    public function restore(AuthUser $authUser, TransaksiBarangMasuk $transaksiBarangMasuk): bool
    {
        return $authUser->can('Restore:TransaksiBarangMasuk');
    }

    public function forceDelete(AuthUser $authUser, TransaksiBarangMasuk $transaksiBarangMasuk): bool
    {
        return $authUser->can('ForceDelete:TransaksiBarangMasuk');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TransaksiBarangMasuk');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TransaksiBarangMasuk');
    }

    public function replicate(AuthUser $authUser, TransaksiBarangMasuk $transaksiBarangMasuk): bool
    {
        return $authUser->can('Replicate:TransaksiBarangMasuk');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TransaksiBarangMasuk');
    }

}