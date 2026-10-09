<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi')->unique();
            $table->date('tanggal');
            $table->foreignId('id_gudang')->constrained('gudangs')->restrictOnDelete();
            $table->foreignId('id_user')->constrained('users')->restrictOnDelete();    // kasir/operator
            $table->foreignId('id_pelanggan')->constrained('users')->restrictOnDelete(); // pembeli
            $table->string('status')->default('aktif'); // aktif | dibatalkan
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penjualan')->constrained('penjualans')->cascadeOnDelete();
            $table->foreignId('id_barang')->constrained('barangs')->restrictOnDelete();
            $table->unsignedInteger('qty');
            $table->unsignedBigInteger('harga_jual'); // snapshot harga saat transaksi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penjualans');
        Schema::dropIfExists('penjualans');
    }
};
