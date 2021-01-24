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

            $table->foreignId('Campaign_id',)->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreignId('Section_id',)->references('id')->on('sections')->onDelete('cascade');
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
