<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_prices', function (Blueprint $table) {
            $table->increments('community_price_id');
            $table->decimal('current_price', 5, 2);
            $table->integer('communitiescommunity_id')->unsigned();
            $table->integer('companiescompany_id')->unsigned();
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
        Schema::dropIfExists('community_prices');
    }
}
