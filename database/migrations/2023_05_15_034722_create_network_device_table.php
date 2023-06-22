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
        Schema::create('network_device', function (Blueprint $table) {
            $table->id();
            $table->string('sn_network');
            $table->string('brand_network');
            $table->string('model_network');
            $table->string('type_network');
            $table->string('port_network');
            $table->string('garansi_network');
            $table->string('tahun_anggaran');
            $table->string('harga_network');
            $table->string('stok');
            $table->string('sisa_stok');
            $table->string('foto_network');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_device');
    }
};
