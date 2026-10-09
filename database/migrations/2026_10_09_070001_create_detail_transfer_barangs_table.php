<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_transfer_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transfer_barang')->constrained('transfer_barangs')->cascadeOnDelete();
            $table->foreignId('id_barang')->constrained('barangs')->restrictOnDelete();
            $table->unsignedInteger('qty');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transfer_barangs');
    }
};
