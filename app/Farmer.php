<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $fillable = ['first_name', 'other_name', 'last_name', 'gender', 'phone_number', 'communitiescommunity_id'];
}
