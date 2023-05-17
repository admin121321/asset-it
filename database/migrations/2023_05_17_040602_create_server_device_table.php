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
        Schema::create('server_device', function (Blueprint $table) {
            $table->id();
            $table->string('sn_server');
            $table->string('brand_server');
            $table->string('model_server');
            $table->string('type_server');
            $table->string('garansi_server');
            $table->string('support_server');
            $table->string('tahun_anggaran');
            $table->string('harga_server');
            $table->string('stok');
            $table->string('foto_server');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_device');
    }
};
