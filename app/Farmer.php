<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $primaryKey = 'farmer_id';
    protected $fillable = ['first_name', 'other_name', 'last_name', 'gender', 'phone_number','farmer_calc', 'communitiescommunity_id'];
}
