<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('towns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('numero',4);   //id del ine
            $table->text('nombre');        //nombre del municipio
            $table->unsignedBigInteger('federal_entitie_id');//id del estado al que pertenece
            
            $table->foreign('federal_entitie_id')->references('id')->on('federal_entities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('towns');
    }
}
