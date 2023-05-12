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
        Schema::create('lisensi_software', function (Blueprint $table) {
            $table->id();
            $table->string('sn_lisensi');
            $table->string('brand_lisensi');
            $table->string('model_lisensi');
            $table->string('type_lisensi');
            $table->string('tahun_anggaran');
            $table->string('harga_lisensi');
            $table->string('key_lisensi');
            $table->string('core_os');
            $table->string('stok');
            $table->string('foto_lisensi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lisensi_software');
    }
};
