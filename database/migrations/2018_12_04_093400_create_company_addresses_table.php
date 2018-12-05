<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_addresses', function (Blueprint $table) {
            $table->increments('company_address_id');
            $table->string('street', 55);
            $table->string('suburb', 55);
            $table->string('city', 55);
            $table->string('country');
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
        Schema::dropIfExists('company_addresses');
    }
}
