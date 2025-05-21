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
        Schema::create('apartamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del apartamento
            $table->text('descripcion'); // Descripción del apartamento
            $table->string('imagen'); // Ruta de la imagen del apartamento
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartamentos');
    }
};
