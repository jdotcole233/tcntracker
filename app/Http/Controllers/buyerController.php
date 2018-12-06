<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buyer;

class buyerController extends Controller
{
    public function register_buyer(Request $request){
        Buyer::create($request->all());
        return response()->json("Buyer added successfully");
    }

    public function list_out_buyers(){
      $buyers = Buyer::all();
      return response()->json($buyers);
    }

    public function editBuyer($id){
      $buyer = Buyer::where('buyer_id', $id)->first();
      return view("dashboard.edit-buyer", compact('buyer'));
    }

    public function editBuyerDetails(Request $request){
        Buyer::find($request->buyer_id)->update([
          'first_name' => $request->first_name,
          'other_name' => $request->other_name,
          'last_name' => $request->last_name,
        //  'location' => $request->location,
          'gender' => $request->gender,
          'phone_number' => $request->phone_number,
        ]);
        return response()->json("Editted Buyer successfully");
    }

}
