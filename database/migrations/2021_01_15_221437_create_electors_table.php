<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->text('nombre');
            $table->text('apellido_p');
            $table->text('apellido_m');
            $table->unsignedBigInteger('Job_id');
            $table->enum('edo_civil', ['soltero','casado','union libre','divorciado', 'viudo'])->nullable();
            $table->date('fecha_nac'); //falaba en diseño bd
            $table->string('telefono', 25);
            $table->string('email', 320);
            $table->text('red_social')->nullable();
            $table->text('calle');
            $table->string('ext_num',6);
            $table->string('int_num',6)->nullable();
            $table->text('colonia')->nullable();
            $table->text('localidad')->nullable();
            $table->text('municipio')->nullable();
            $table->string('cp', 25)->nullable();
            $table->unsignedBigInteger('seccion'); //hacerla foreign?
            $table->text('clave_elector');
            $table->text('foto_elector')->nullable();
            $table->text('credencial_a');
            $table->text('credencial_r');
            $table->text('documento')->nullable();

            $table->foreign('Job_id')->references('id')->on('jobs')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('electors');
    }
}
