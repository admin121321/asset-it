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
        Schema::create('desktop_device', function (Blueprint $table) {
            $table->id();
            $table->string('sn_desktop');
            $table->string('brand_desktop');
            $table->string('model_desktop');
            $table->string('type_desktop');
            $table->string('tahun_anggaran');
            $table->string('harga_desktop');
            $table->string('stok');
            $table->string('foto_desktop');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desktop_device');
    }
};
