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
        Schema::create('cifras', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('tom');
            $table->foreignId('id_musica')->references('id')->on('musicas');
            $table->string('urlNuvem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cifras');
    }
};
