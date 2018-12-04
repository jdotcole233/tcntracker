<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer_farm extends Model
{
    protected $fillable = [
      'farm_size',
      'farmer_farm_question',
      'buyersbuyer_id',
      'farmersfarmer_id'
    ];
}
