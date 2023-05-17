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
        Schema::create('server_akun', function (Blueprint $table) {
            $table->id();
            $table->string('server_id');
            $table->string('akun_server');
            $table->string('password_server');
            $table->string('tujuan_akses_server');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_akun');
    }
};
