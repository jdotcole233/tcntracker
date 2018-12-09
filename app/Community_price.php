<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community_price extends Model
{
    protected $primaryKey = 'community_price_id';
    protected $fillable = [
      'current_price',
      'communitiescommunity_id',
      'companiescompany_id'
    ];
}
