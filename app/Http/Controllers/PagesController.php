<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmer;
use App\Buyer;
use Farmer_transaction;


class PagesController extends Controller
{
    public function index(){
     $total_farmers = Farmer::where('communitiescommunity_id', 1);
     $total_buyers = Buyer::where('companiescompany_id', 1);
     if ($total_farmers != null && $total_buyers != null){
       $total_farmers = Farmer::where('communitiescommunity_id', 1)->count();
       $total_buyers = Buyer::where('companiescompany_id', 1)->count();
     } else {
       $total_farmers = 0;
       $total_buyers = 0;
     }
      //$total_transactions = Farmer_transaction::where('companiescompany_id', 1)->sum('total_weight');
    	return view("dashboard.index", compact('total_farmers','total_buyers'));
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

    public function createSale(){
    	return view("dashboard.create-sale");
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

    public function updatePrice(){
    	return view("dashboard.update-price");
    }
    public function signin(){
    	return view("auth.signin");
    }
    public function signup(){
    	return view("auth.signup");
    }

}
