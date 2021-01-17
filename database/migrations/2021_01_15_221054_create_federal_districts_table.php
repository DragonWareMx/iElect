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
