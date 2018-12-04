<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_address extends Model
{
    protected $fillable = [
      'street',
      'suburb',
      'city',
      'country',
      'companiescompany_id'

    ]
}
