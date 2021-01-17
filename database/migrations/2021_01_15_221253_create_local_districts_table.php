<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_districts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numero', 4);   //id del ine
            $table->text('cabecera');       //nombre del municipio cabecera
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_districts');
    }
}
