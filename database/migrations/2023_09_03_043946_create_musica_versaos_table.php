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
        Schema::create('musica_versaos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('autor');
            $table->unsignedBigInteger('musica_id');
            $table->foreign('musica_id')->references('id')->on('musicas');
            $table->text('letra');
            $table->string('url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musica_versaos');
    }
};
