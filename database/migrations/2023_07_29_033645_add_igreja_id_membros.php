<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('membros', function($table) {
            $table->foreignId('id_igreja')->nullable()->references('id')->on('igrejas');

        });
    }

    public function down()
    {
        Schema::table('membros', function($table) {
            $table->dropColumn('id_igreja');
        });
    }
};
