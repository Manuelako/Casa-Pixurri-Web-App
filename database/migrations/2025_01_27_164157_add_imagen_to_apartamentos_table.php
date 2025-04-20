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
        Schema::table('apartamentos', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('duplex'); // Agrega la columna 'imagen' después de 'duplex'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('apartamentos', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
};
