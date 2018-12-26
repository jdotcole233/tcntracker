<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

use App\Company;
use App\User;


class otherController extends Controller
{
    public function createCompanyAccount(Request $request){
        $company_id = Company::create($request->all())->latest()->value('company_id');
        
        $enc_password = Hash::make($request->password);
        User::create([
            'email' => $request->email,
            'password' => $enc_password,
            'companiescompany_id' => $company_id

        ]);

        return response()->json('Company added successfully'.$company_id);

    }
}
