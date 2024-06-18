<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tratamiento_id')->nullable();
            $table->unsignedBigInteger('cita_id')->nullable();
            $table->enum('tipo_pago', ['cita', 'tratamiento']);
            $table->decimal('monto', 10, 2);
            $table->timestamp('fecha_pago')->nullable();
            $table->string('metodo_pago', 255)->nullable();
            $table->unsignedBigInteger('usuario_id');
            $table->enum('estado', ['pendiente', 'pagado'])->default('pendiente');
            $table->timestamps();

            $table->foreign('tratamiento_id')->references('id')->on('tratamientos')->onDelete('cascade');
            $table->foreign('cita_id')->references('id')->on('citas')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
