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
}
