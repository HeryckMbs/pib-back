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
        Schema::create('categoria_musical_musicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_musica')->references('id')->on('musicas');
            $table->foreignId('id_caregoria')->references('id')->on('categoria_musicals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_musical_musicas');
    }
};
