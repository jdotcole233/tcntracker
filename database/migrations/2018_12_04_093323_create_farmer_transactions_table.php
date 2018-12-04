<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmerTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_transactions', function (Blueprint $table) {
            $table->increments('farmer_transactions_id');
            $table->decimal('unit_price',5, 2);
            $table->decimal('total_weight', 10,1);
            $table->decimal('total_amount_paid', 10, 2);
            $table->integer('farmersfarmer_id')->unsigned();
            $table->integer('buyersbuyer_id')->unsigned();
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
        Schema::dropIfExists('farmer_transactions');
    }
}
