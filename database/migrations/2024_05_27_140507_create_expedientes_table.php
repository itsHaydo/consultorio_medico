<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('expedientes')) {
            Schema::create('expedientes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('consulta_id');
                $table->unsignedBigInteger('paciente_id');
                $table->date('fecha');
                $table->text('seguimiento');
                $table->timestamps();

                $table->foreign('consulta_id')->references('id')->on('consulta')->onDelete('cascade');
                $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
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

        // Drop the table
        Schema::dropIfExists('expedientes');

        Schema::enableForeignKeyConstraints();
    }
}
