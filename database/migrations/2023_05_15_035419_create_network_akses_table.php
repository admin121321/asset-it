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
        Schema::create('network_akses', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('network_id');
            $table->string('ip_akses');
            $table->string('akun_akses');
            $table->string('password_akses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_akses');
    }
};
