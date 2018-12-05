<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerFarmerRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_farmer_registrations', function (Blueprint $table) {
            $table->increments('buyer_farmers_registrations_id');
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
        Schema::dropIfExists('buyer_farmer_registrations');
    }
}
