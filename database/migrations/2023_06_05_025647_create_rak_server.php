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
        Schema::create('rak_server', function (Blueprint $table) {
            $table->id();
            $table->string('brand_rak');
            $table->string('type_rak');
            $table->string('kode_rak');
            $table->string('dimensi_rak');
            $table->string('ukuran_u_rak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rak_server');
    }
};
