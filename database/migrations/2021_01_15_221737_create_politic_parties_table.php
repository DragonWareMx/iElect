<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliticPartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('politic_parties', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name',45); //nombre del partido
            $table->string('siglas',10); 
            $table->string('logo',250); //url de la imagen del logo
            $table->string('color',250); //codigo del color para gráficas
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('politic_parties');
    }
}
