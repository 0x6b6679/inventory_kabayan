<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DetailTransaksiBarangMasuk;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailTransaksiBarangMasukPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:DetailTransaksiBarangMasuk');
    }

    public function view(AuthUser $authUser, DetailTransaksiBarangMasuk $detailTransaksiBarangMasuk): bool
    {
        return $authUser->can('View:DetailTransaksiBarangMasuk');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:DetailTransaksiBarangMasuk');
    }

    public function update(AuthUser $authUser, DetailTransaksiBarangMasuk $detailTransaksiBarangMasuk): bool
    {
        return $authUser->can('Update:DetailTransaksiBarangMasuk');
    }

    public function delete(AuthUser $authUser, DetailTransaksiBarangMasuk $detailTransaksiBarangMasuk): bool
    {
        return $authUser->can('Delete:DetailTransaksiBarangMasuk');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:DetailTransaksiBarangMasuk');
    }

    public function restore(AuthUser $authUser, DetailTransaksiBarangMasuk $detailTransaksiBarangMasuk): bool
    {
        return $authUser->can('Restore:DetailTransaksiBarangMasuk');
    }

    public function forceDelete(AuthUser $authUser, DetailTransaksiBarangMasuk $detailTransaksiBarangMasuk): bool
    {
        return $authUser->can('ForceDelete:DetailTransaksiBarangMasuk');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:DetailTransaksiBarangMasuk');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:DetailTransaksiBarangMasuk');
    }

    public function replicate(AuthUser $authUser, DetailTransaksiBarangMasuk $detailTransaksiBarangMasuk): bool
    {
        return $authUser->can('Replicate:DetailTransaksiBarangMasuk');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:DetailTransaksiBarangMasuk');
    }

}