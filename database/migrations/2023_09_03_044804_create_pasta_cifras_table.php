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
        Schema::create('pasta_cifras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasta_id');
            $table->foreign('pasta_id')->references('id')->on('pastas');
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
        Schema::dropIfExists('pasta_cifras');
    }
};
