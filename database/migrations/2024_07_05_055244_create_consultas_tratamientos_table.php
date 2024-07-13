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
        Schema::create('consultas_tratamientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_id');
            $table->unsignedBigInteger('tratamiento_id');
            $table->timestamps();

            $table->foreign('consulta_id')->references('id')->on('consulta')->onDelete('cascade');
            $table->foreign('tratamiento_id')->references('id')->on('tratamientos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas_tratamientos');
    }
};
