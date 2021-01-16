<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('num_seccion', 6);
            $table->int('casillas')->nullable();
            $table->enum('prioridad', ['Alta','Media','Baja']);
            $table->unsignedBigInteger('Federal_District_id');
            $table->unsignedBigInteger('Local_District_id');
            $table->unsignedBigInteger('hombres');
            $table->unsignedBigInteger('mujeres');
            $table->unsignedBigInteger('18');
            $table->unsignedBigInteger('19');
            $table->unsignedBigInteger('20_24');
            $table->unsignedBigInteger('25_29');
            $table->unsignedBigInteger('30_34');
            $table->unsignedBigInteger('35_39');
            $table->unsignedBigInteger('40_44');
            $table->unsignedBigInteger('45_49');
            $table->unsignedBigInteger('50_54');
            $table->unsignedBigInteger('55_59');
            $table->unsignedBigInteger('60_64');    
            $table->unsignedBigInteger('65_mas');
            
            $table->foreign('Federal_District_id')->references('id')->on('federal_districts')->onDelete('cascade');
            $table->foreign('Local_District_id')->references('id')->on('local_districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
