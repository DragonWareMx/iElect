<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignPartieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_partie', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('Campaign_id',)->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreignId('Politic_Partie_id',)->references('id')->on('politic_parties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_partie');
    }
}
