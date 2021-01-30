<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_section', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('prioridad', ['Alta','Media','Baja']); //prioridad de la sección según meta o cliente
            $table->integer('meta');                            //meta de la seccion segun el cliente

            $table->foreignId('campaign_id',)->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreignId('section_id',)->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_section');
    }
}
