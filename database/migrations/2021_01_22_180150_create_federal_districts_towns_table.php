<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFederalDistrictsTownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federal_districts_towns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('Federal_District_id',)->references('id')->on('federal_districts')->onDelete('cascade');
            $table->foreignId('town_id',)->references('id')->on('towns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('federal_districts_towns');
    }
}
