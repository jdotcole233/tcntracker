<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;

class communityController extends Controller
{
    public function register_community(Request $request){
        Community::create($request->all());
        return response()->json("Community Added successfully");
    }

    public function list_out_communities(){
       $communities = Community::all();
       return response()->json($communities);
    }

    public function list_community($id){
       $community = Community::where('community_id', $id)->first();
       return view('dashboard.view-community', compact('community'));
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
}
