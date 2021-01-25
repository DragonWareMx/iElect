<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignPoliticPartieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_politic_partie', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('campaign_id',)->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreignId('politic_partie_id',)->references('id')->on('politic_parties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_politic_partie');
    }
}
