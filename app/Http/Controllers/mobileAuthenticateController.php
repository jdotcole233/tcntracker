<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Buyer_community;
use App\Buyer_farmer_registration;
use App\Community_price;
use App\Farmer_transaction;
use App\Community;
use App\Farmer;

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

        return response()->json([
          "buyer_info" => $buyerDetails,
          "total_farmers" => $total_farmers_registered,
          "total_weight" => $total_weight_bought,
          "current_price" => $current_price
        ]);

        // return response()->json($buyerDetails);
      }

        return response()->json("null");
    }



    public function mobileCommunityList(Request $request){
        $communities = Community::where('companiescompany_id', $request->company_id)->get();
        return response()->json(["community"=> $communities]);
    }

    public function registerFarmerFromMobileDevice(Request $request){

        $farmer_id = Farmer::create([
          "first_name" => $request->first_name,
          "other_name" => $request->other_name,
          "last_name" => $request->last_name,
          "gender" => $request->gender,
          "phone_number" => $request->phone_number,
          "communitiescommunity_id" => $request->community_id,
          "companiescompany_id" => $request->company_id,
          "created_at" => $request->created_at,
          "updated_at" => $request->created_at

        ])->latest()->value("farmer_id");

        Buyer_farmer_registration::create([
          "buyersbuyer_id" => $request->buyer_id,
          "farmersfarmer_id" => $farmer_id
        ]);


        return response()->json(["response" => "SUCCESSFUL"]);
    }


    public function farmer_transactions_operation(Request $request){
      $farmer_id = Farmer::where('phone_number', $request->phone_number)->value('farmer_id');
      Farmer_transaction::create([
        "farmersfarmer_id" => $farmer_id,
        "unit_price" => $request->unit_price,
        "total_weight" => $request->total_weight,
        "total_amount_paid" => $request->total_amount_paid,
        "buyersbuyer_id" => $request->buyer_id,
        "companiescompany_id" => $request->company_id,
        "created_at" => $request->created_at,
        "updated_at" => $request->created_at
      ]);


        return response()->json(["response" => "SUCCESSFUL"]);
    }



}
