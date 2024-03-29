<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFederalDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federal_districts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('numero',4);         //id del ine
            $table->text('cabecera');           //nombre municipio cabecera
            $table->string('coordenadas');      //coordenadas para ubicar el mapa
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('federal_districts');
    }
}
