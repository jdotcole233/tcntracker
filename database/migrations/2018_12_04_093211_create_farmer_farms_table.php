<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmerFarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_farms', function (Blueprint $table) {
            $table->increments('farmer_farms_id');
            $table->string('farm_size', 40);
            $table->string('farmer_farm_question', 212);
            $table->integer('buyersbuyer_id')->unsigned();
            $table->integer('farmersfarmer_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmer_farms');
    }
}
