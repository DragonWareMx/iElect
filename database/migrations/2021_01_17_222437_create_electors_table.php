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
            $table->uuid('uuid')->index()->unique();
            $table->timestamps();

            $table->text('nombre');
            $table->text('apellido_p');
            $table->text('apellido_m')->nullable();
            $table->unsignedBigInteger('job_id');
            $table->enum('edo_civil', ['soltero', 'casado', 'unionl', 'divorciado', 'separado', 'viudo'])->nullable();
            $table->date('fecha_nac'); //falaba en diseño bd
            $table->string('telefono', 12)->nullable();
            $table->string('email', 320)->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('calle')->nullable();
            $table->string('ext_num', 6)->nullable();
            $table->string('int_num', 6)->nullable();
            $table->text('colonia');
            $table->text('localidad')->nullable();
            $table->text('municipio')->nullable();
            $table->string('cp', 25);
            $table->unsignedBigInteger('section_id');    //id de seccion a la que pertenece
            $table->unsignedBigInteger('campaign_id');   //id de campaña SE AGREGÓ
            $table->unsignedBigInteger('user_id');         //brigadista que lo dio de alta SE AGREGÓ
            $table->text('clave_elector');          //clave del ine
            $table->text('foto_elector')->nullable(); //foto, no se va a ocupar casi nunca
            $table->text('credencial_a'); //foto credencial ine enfrente
            $table->text('credencial_r'); //foto credencial ine atrás
            $table->text('documento')->nullable();  //documento de privacidad si aplica
            $table->boolean('aprobado')->default(0); //Si ya fue aprovado por un agente o no,
            $table->enum('sexo', ['m','h']); //m = mujer, h = hombre
            //IMPORTANTE: sólo los aprobados se toman en cuenta en estadísticas


            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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