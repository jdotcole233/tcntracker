<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmer;
use App\Farmer_transaction;

class farmerController extends Controller
{
    public function register_farmer(Request $request){
        Farmer::create($request->all());
        return response()->json("Farmer added successfully");
    }

    public function list_out_farmers(){
      $farmers = Farmer::all();
      return response()->json($farmers);
    }

    public function create_sale(Request $request){
        Farmer_transaction::create($request->all());

        return response()->json("Sale created successfully");
    }


    public function viewFarmer($id){
      $farmer = Farmer::where('farmer_id', $id)->first();
    	return view("dashboard.view-farmer", compact('farmer'));
    }

    public function editFarmer($id){
      $farmer = Farmer::where('farmer_id', $id)->first();
      return view("dashboard.edit-farmer", compact('farmer'));
    }

    public function editFarmerDetails(Request $request){
        Farmer::find($request->farmer_id)->update([
          'first_name' => $request->first_name,
          'other_name' => $request->other_name,
          'last_name' => $request->last_name,
        //  'location' => $request->location,
          'gender' => $request->gender,
          'phone_number' => $request->phone_number,
        ]);
        return response()->json("Editted successfully");
    }
}
