<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	return view("dashboard.index");
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
    public function editBuyer(){
    	return view("dashboard.edit-buyer");
    }
    public function farmers(){
    	return view("dashboard.farmers");
    }
    public function farmerSales(){
    	return view("dashboard.farmer-sales");
    }
    public function viewFarmer(){
    	return view("dashboard.view-farmer");
    }
    public function createFarmer(){
    	return view("dashboard.create-farmer");
    }
    public function editFarmer(){
    	return view("dashboard.edit-farmer");
    }
    public function createSale(){
    	return view("dashboard.create-sale");
    }
    public function editSale(){
    	return view("dashboard.edit-sale");
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
    public function editCommunity(){
    	return view("dashboard.edit-community");
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
