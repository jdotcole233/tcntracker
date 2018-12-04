<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
  protected $fillable = ['first_name', 'other_name', 'last_name', 'gender', 'phone_number', 'companiescompany_id'];

}
