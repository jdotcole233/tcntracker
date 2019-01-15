<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class mobileAuthenticateController extends Controller
{

    public function handle(Request $request){

      $credentials = $request->only('email','password');

      if (Auth::attempt($credentials)){
          $buyerID = Auth::user()->buyersbuyer_id;
          if ($buyerDetails == null){
            return;
          }
          $buyerDetails = DB::table('buyers')->join('buyer_communities','buyers.buyer_id','buyers_communities.buyer_id')->where('buyers_id', $buyerID)->first();
          $total_farmers_registered = Buyer_farmer_registration::where('buyersbuyer_id', $buyerID)->count();
          $total_weight_bought = Farmer_transaction::where('buyersbuyer_id', $buyerID)->sum('total_weight');
          $current_price = Community_price::where('communitiescommunity_id', $buyerDetails->community_id)->latest()->value('current_price');

        return response()->json($buyerDetails);
      }

        return response()->json("null");
    }
}
