<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $primaryKey = 'community_id';
    protected $fillable = [
      'region_name', 'district_name', 'community_name', 'companiescompany_id'
    ];
}
