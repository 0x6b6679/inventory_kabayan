<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi_barang_masuks', function (Blueprint $table) {
            $table->string('status')->default('aktif')->after('keterangan'); // aktif | dibatalkan
        });

        Schema::table('transfer_barangs', function (Blueprint $table) {
            $table->string('status')->default('aktif')->after('keterangan'); // aktif | dibatalkan
        });
    }

    public function down(): void
    {
        Schema::table('transaksi_barang_masuks', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('transfer_barangs', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
