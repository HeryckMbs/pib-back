<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cultos', function($table) {
            $table->foreignId('id_mensageiro')->references('id')->on('membros');

        });
    }

    public function down()
    {
        Schema::table('cultos', function($table) {
            $table->dropColumn('id_mensageiro');
        });
    }
};
