<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mensagems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_culto')->references('id')->on('cultos');
            $table->foreignId('id_membro')->references('id')->on('membros');
            $table->string('titulo');
            $table->string('resumo');
            $table->string('linkYoutube');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensagems');
    }
};
