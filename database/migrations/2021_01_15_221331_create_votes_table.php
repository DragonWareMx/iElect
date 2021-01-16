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

            $table->unsignedInteger('num');
            $table->unsignedBigInteger('Section_id');
            $table->unsignedBigInteger('Politic_Parties_id');
            $table->unsignedBigInteger('Election_id');
            $table->foreign('Section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('Politic_Parties_id')->references('id')->on('politic_parties')->onDelete('cascade');
            $table->foreign('Election_id')->references('id')->on('elections')->onDelete('cascade');
            //falta la que la relaciona con la tabla puestos
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
