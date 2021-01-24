<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('Town_id');
            $table->unsignedBigInteger('Federal_District_id');   //id del distrito federal al que pertenece la sección
            $table->unsignedBigInteger('Local_District_id');    //id del distrito local al que pertenece la sección
            $table->string('num_seccion', 6);                   //id de la sección en el INE
            $table->unsignedInteger('casillas')->nullable();    //numero de casillas
            $table->enum('prioridad', ['Alta','Media','Baja']); //prioridad de la sección según meta o cliente
            
            $table->unsignedBigInteger('hombres');               //cantidad total de hombres en la sección
            $table->unsignedBigInteger('mujeres');              //cantidad total de mujeres en la sección
            $table->unsignedBigInteger('18');                   //rangos de edades sin diferenciar hombres o mujeres
            $table->unsignedBigInteger('19');
            $table->unsignedBigInteger('20_24');
            $table->unsignedBigInteger('25_29');
            $table->unsignedBigInteger('30_34');
            $table->unsignedBigInteger('35_39');
            $table->unsignedBigInteger('40_44');
            $table->unsignedBigInteger('45_49');
            $table->unsignedBigInteger('50_54');
            $table->unsignedBigInteger('55_59');
            $table->unsignedBigInteger('60_64');    
            $table->unsignedBigInteger('65_mas');
            
            $table->foreign('Town_id')->references('id')->on('towns')->onDelete('cascade');
            $table->foreign('Federal_District_id')->references('id')->on('federal_districts')->onDelete('cascade');
            $table->foreign('Local_District_id')->references('id')->on('local_districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
