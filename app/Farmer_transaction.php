<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer_transaction extends Model
{
    protected $fillable = [
      'unit_price',
      'total_weight',
      'total_amount_paid',
      'farmersfarmer_id',
      'buyersbuyer_id'
    ];
    // Remember to change buyer id from null in the Database
    // I only set it to null to make sure the web portal works properly
}
