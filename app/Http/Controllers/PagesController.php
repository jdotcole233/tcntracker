<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmer;
use App\Buyer;
use App\Farmer_transaction;
use App\Community_price;
use Auth;


class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
     $total_farmers = Farmer::where('companiescompany_id', Auth::user()->companiescompany_id)->count();
     $total_buyers = Buyer::where('companiescompany_id', Auth::user()->companiescompany_id)->count();
     $average_price=0.0;
     $average_price_num = Community_price::where('companiescompany_id', Auth::user()->companiescompany_id)->count();
      if ($average_price_num != 0){
        $average_price_total = Community_price::where('companiescompany_id', Auth::user()->companiescompany_id)->sum('current_price');
        $average_price = $average_price_total / $average_price_num;
      }
      $average_price = round($average_price, 2);
     
      $total_transactions = Farmer_transaction::where('companiescompany_id', Auth::user()->companiescompany_id)->sum('total_weight');
    	return view("dashboard.index", compact('total_farmers','total_buyers', 'average_price', 'total_transactions'));
    }
    public function farmerProfile(){
    	return view("dashboard.farmer-profile");
    }
    public function buyerProfile(){
    	return view("dashboard.buyer-profile");
    }
    public function createBuyer(){
    	return view("dashboard.create-buyer");
    }

    public function farmers(){
    	return view("dashboard.farmers");
    }

    // public function viewFarmer(){
    // 	return view("dashboard.view-farmer");
    // }
    public function createFarmer(){
    	return view("dashboard.create-farmer");
    }



    public function communities(){
    	return view("dashboard.communities");
    }
    public function viewCommunity(){
    	return view("dashboard.view-community");
    }
    public function createCommunity(){
    	return view("dashboard.create-community");
    }


    public function addPrice(){
      return view("dashboard.add-price");
    }


}
