<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ussdlog extends Model
{
     protected $fillable = ['phonenumber', 'isregistered', 'created_at', 'updated_at'];
}
