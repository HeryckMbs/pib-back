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
        Schema::create('evento_musicas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_evento')->references('id')->on('eventos');
            $table->foreignId('id_musica')->references('id')->on('musicas');
            $table->integer('ordem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evento_musicas');
    }
};
