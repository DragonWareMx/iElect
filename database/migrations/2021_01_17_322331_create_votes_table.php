<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedInteger('num');   // numero de votos por seccion, partido,elección y puesto
            $table->unsignedBigInteger('Section_id'); //id de seccion
            $table->unsignedBigInteger('Politic_Parties_id'); //id de partido
            $table->unsignedBigInteger('Election_id'); //id de elección
            $table->unsignedBigInteger('Position_id'); //id de puesto

            $table->foreign('Section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('Politic_Parties_id')->references('id')->on('politic_parties')->onDelete('cascade');
            $table->foreign('Election_id')->references('id')->on('elections')->onDelete('cascade');
            $table->foreign('Position_id')->references('id')->on('positions')->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
