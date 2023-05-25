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
        Schema::create('server_penggunaan', function (Blueprint $table) {
            $table->id();
            $table->string('server_id');
            $table->string('hostname_server');
            $table->string('url_server');
            $table->string('port_akses_server');
            $table->string('ip_address_server');
            $table->string('ip_management_server');
            $table->string('web_server');
            $table->string('php_server');
            $table->string('db_server');
            $table->string('application_server');
            $table->string('deskripsi_server');
            $table->timestamps();       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_penggunaan');
    }
};
