<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\Community_price;
use Auth;

class communityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_community(Request $request){
        Community::create($request->all());
        return response()->json("Community Added successfully");
    }

    public function list_out_communities(){
       $communities = Community::where('companiescompany_id', Auth::user()->companiescompany_id)->get();
       return response()->json($communities);
    }

    public function list_community($id){
       $community = Community::where('community_id', $id)->first();
       $current_comm_price = Community_price::where('communitiescommunity_id', $id)->latest()->value('current_price');
       return view('dashboard.view-community', compact('community','current_comm_price'));
    }

    public function editCommunity($id){
      $community = Community::where('community_id', $id)->first();
      return view("dashboard.edit-community", compact('community'));
    }

    public function update_community_details(Request $request){
        Community::find($request->community_id)->update([
          'community_name' => $request->community_name,
          'region_name' => $request->region_name
        ]);
        return response()->json("Updated successfully");
    }


    public function add_priceto_community(Request $request){
      Community_price::create($request->all());
      return response()->json("Community Price Added successfully!!");
    }

    public function communityPrices($id){
      $community_prices = Community_price::where('communitiescommunity_id', $id)->orderBy('created_at','desc')->get();
      return view("dashboard.view-community-prices", compact('community_prices'));
    }

    public function updatePrice($id){
      $community_price = Community_price::where('community_price_id', $id)->first();
      return view("dashboard.update-price", compact('community_price'));
    }

    public function update_current_prices(Request $request){
        Community_price::find($request->community_price_id)->update([
            'current_price' => $request->current_price
        ]);

        return response()->json("Updated successfully");
    }



}
