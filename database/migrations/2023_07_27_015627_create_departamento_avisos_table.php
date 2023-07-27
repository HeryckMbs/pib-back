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
        Schema::create('departamento_avisos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_departamento')->references('id')->on('departamentos');
            $table->foreignId('id_membro')->references('id')->on('membros');
            $table->string('nome');
            $table->string('aviso');
            $table->string('titulo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamento_avisos');
    }
};
