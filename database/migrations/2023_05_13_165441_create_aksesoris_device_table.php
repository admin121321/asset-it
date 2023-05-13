<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aksesoris_device', function (Blueprint $table) {
            $table->id();
            $table->string('sn_aksesoris');
            $table->string('brand_aksesoris');
            $table->string('model_aksesoris');
            $table->string('type_aksesoris');
            $table->string('garansi_aksesoris');
            $table->string('tahun_anggaran');
            $table->string('harga_aksesoris');
            $table->string('stok');
            $table->string('foto_aksesoris');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aksesoris_device');
    }
};
