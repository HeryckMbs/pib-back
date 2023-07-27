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
        Schema::create('cifras_pastas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasta')->references('id')->on('pastas');
            $table->foreignId('id_cifra')->references('id')->on('cifras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cifras_pastas');
    }
};
