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
        Schema::create('printer_devices', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number');
            $table->string('brand_printer');
            $table->string('model_printer');
            $table->string('type_printer');
            $table->string('tahun_anggaran');
            $table->string('harga_printer');
            $table->string('stok');
            $table->string('foto_printer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printer_devices');
    }
};
