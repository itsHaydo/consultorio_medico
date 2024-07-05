<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()// modificar la tabla de tratamientos con lo anotado del cuaderno
    {
        if (!Schema::hasTable('tratamientos')) {
            Schema::create('tratamientos', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('medicamento_id');
                $table->unsignedBigInteger('doctor_id');
                $table->date('fecha_inicio')->nullable();
                $table->date('fecha_fin')->nullable();
                $table->text('descripcion');
                $table->timestamps();

                $table->foreign('medicamento_id')->references('id')->on('medicamentos')->onDelete('cascade');
                $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('tratamientos');

        Schema::enableForeignKeyConstraints();
    }
}
