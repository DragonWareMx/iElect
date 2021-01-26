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
            $table->unsignedBigInteger('section_id'); //id de seccion
            $table->unsignedBigInteger('politic_partie_id'); //id de partido
            $table->unsignedBigInteger('election_id'); //id de elección
            $table->unsignedBigInteger('position_id'); //id de puesto

            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('politic_partie_id')->references('id')->on('politic_parties')->onDelete('cascade');
            $table->foreign('election_id')->references('id')->on('elections')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
            
            
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
