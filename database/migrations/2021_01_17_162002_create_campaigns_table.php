<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name', 100);   //nombre de la campaña, nombre de la coalision, etc
            $table->string('candidato'); //candidato de la campaña
            $table->string('codigo', 15)->unique(); //codigo de la campaña para brigadistas
            $table->string('logo')->nullable(); //Logo de la campaña
            $table->unsignedBigInteger('position_id'); //id del puesto político que busca el candidato

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
        Schema::dropIfExists('campaigns');
    }
}