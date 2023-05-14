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
        Schema::create('ssid_wifi', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('ssid_name');
            $table->string('ip_segment');
            $table->string('provider');
            $table->string('lokasi_ssid');
            $table->string('user_ssid');
            $table->string('password_lama');
            $table->string('password_baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ssid_wifi');
    }
};
