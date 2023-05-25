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
        Schema::create('server_spek', function (Blueprint $table) {
            $table->id();
            $table->string('server_id');
            $table->string('ram_server');
            $table->string('hardisk_server');
            $table->string('processor_server');
            $table->string('core_server');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_spek');
    }
};
