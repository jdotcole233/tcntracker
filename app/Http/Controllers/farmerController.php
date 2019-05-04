<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmer;
use App\Farmer_transaction;
use App\Community;
use App\Community_price;
use Auth;

class farmerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_farmer(Request $request){
        Farmer::create($request->all());
        return response()->json("Farmer added successfully");
    }

    public function list_out_farmers(){
      $farmers = Farmer::where('companiescompany_id', Auth::user()->companiescompany_id)->get();
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


    // Farmer sales
    public function farmerSales($id){
      $farmer_transactions = Farmer_transaction::where('farmersfarmer_id', $id)->get();
      return view("dashboard.farmer-sales", compact('farmer_transactions','id'));
    }

    public function editSale($id){
      $farmer_sale = Farmer_transaction::where('farmer_transactions_id', $id)->first();
      return view("dashboard.edit-sale", compact('farmer_sale'));
    }

    public function editSaleDetails(Request $request){

        Farmer_transaction::find($request->farmer_transactions_id)->update([
          'unit_price' => $request->unit_price,
          'total_weight' => $request->total_weight,
          'total_amount_paid' => $request->total_amount_paid
        ]);

        return response()->json("sale update successfully");
    }

    public function createSale($id) {
      $farmer = Farmer::where('farmer_id', $id)->first();
      return view("dashboard.create-sale", compact('farmer'));
    }

}
