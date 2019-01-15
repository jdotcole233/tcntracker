<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Buyer_community;
use App\Buyer_farmer_registration;
use App\Community_price;
use App\Farmer_transaction;

class mobileAuthenticateController extends Controller
{

    public function handle(Request $request){

      $credentials = $request->only('email','password');

      if (Auth::attempt($credentials)){
          $buyerID = Auth::user()->buyersbuyer_id;
          if ($buyerID == null){
            return;
          }
          $buyerDetails = DB::table('buyers')->join('buyer_communities','buyers.buyer_id','buyer_communities.buyersbuyer_id')->where('buyer_id', $buyerID)->first();
          $total_farmers_registered = Buyer_farmer_registration::where('buyersbuyer_id', $buyerID)->count();
          $total_weight_bought = Farmer_transaction::where('buyersbuyer_id', $buyerID)->sum('total_weight');
          $current_price = Community_price::where('communitiescommunity_id', $buyerDetails->communitiescommunity_id)->latest()->value('current_price');

        // return response()->json([
        //   "buyer_info" => $buyerDetails,
        //   "total_farmers" => $total_farmers_registered,
        //   "total_weight" => $total_weight_bought,
        //   "current_price" => $current_price
        // ]);

        return response()->json($buyerDetails);
      }

        return response()->json("null");
    }
}
