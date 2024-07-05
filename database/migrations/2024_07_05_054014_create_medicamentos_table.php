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
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255)->nullable(false);
            $table->string('descripcion', 255)->nullable();
            $table->float('precio')->nullable(false);
            $table->date('fecha_caducidad')->nullable(false);
            $table->integer('cantidad')->nullable(false);
            $table->enum('medida', ['ml', 'caja', 'l', 'pieza'])->nullable(false);
            $table->enum('estado', ['agotado', 'disponible'])->default('disponible')->nullable(false); // disponible, agotado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos');
    }
};
