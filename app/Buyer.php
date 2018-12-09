<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
  protected $primaryKey = 'buyer_id';
  protected $fillable = ['first_name', 'other_name', 'last_name', 'gender', 'phone_number', 'companiescompany_id'];

}
