<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Buyer;
use App\Buyer_community;
use Auth;
use App\User;

class buyerController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function register_buyer(Request $request){
        $buyer_id = Buyer::create($request->all())->latest()->value('buyer_id');
        Buyer_community::create([
          'communitiescommunity_id' => $request->communitiescommunity_id,
          'buyersbuyer_id' => $buyer_id
        ]);
        User::create([
          'email'=> $request->buyer_email,
          'password' => Hash::make('123456'),
          'buyersbuyer_id' => $buyer_id
        ]);
        return response()->json("Buyer added successfully");
    }

    public function list_out_buyers(){
      $buyers = Buyer::join('buyer_communities', 'buyer_id', 'buyersbuyer_id')
      ->join('communities', 'community_id','communitiescommunity_id')
      ->where('buyers.companiescompany_id', Auth::user()->companiescompany_id)->get();
  
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
