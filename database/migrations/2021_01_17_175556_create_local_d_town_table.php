<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalDTownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_d_town', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('Local_District_id',)->references('id')->on('local_districts')->onDelete('cascade');
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
        Schema::dropIfExists('local_d_town');
    }
}
