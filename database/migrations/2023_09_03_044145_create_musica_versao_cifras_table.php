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
        Schema::create('musica_versao_cifras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('musica_versao_id');
            $table->foreign('musica_versao_id')->references('id')->on('musica_versaos');
            $table->unsignedBigInteger('cifra_id');
            $table->foreign('cifra_id')->references('id')->on('cifras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musica_versao_cifras');
    }
};
