<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mobileAuthenticateController extends Controller
{

    public function handle(Request $request){


        return response()->json("Welcome to this site");
    }
}
