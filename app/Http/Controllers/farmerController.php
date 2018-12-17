<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmer;
use App\Farmer_transaction;
use App\Community;
use App\Community_price;

class farmerController extends Controller
{

    // private static ;

    public function register_farmer(Request $request){
        Farmer::create($request->all());
        return response()->json("Farmer added successfully");
    }

    public function list_out_farmers(){
      $farmers = Farmer::all();
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
      return view("dashboard.farmer-sales", compact('farmer_transactions'));
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




    //Famer ussd controls

    public function farmerapplicationcontrol(Request $request){
      $incoming_phone = $request->MSISDN;
      // $found_name = "";
       $exist_farmer_phone = Farmer::where('phone_number',  "050848404")->value("first_name");
       $income_array = $this->ussd_outputsarray();
      //
      // //Farmer exists in tontracker database
      // if($exist_farmer_phone != null){
      //   $found_name = $exist_farmer_phone->first_name . " " . $exist_farmer_phone->other_name . " " . $exist_farmer_phone->last_name; //get farmer name
      //   $community_name = Community::where("community_id", $exist_farmer_phone->communitiescommunity_id)->value("community_name"); //get community name
      //   $found_comm_price = Community_price::where('communitiescommunity_id', $exist_farmer_phone->communitiescommunity_id)->latest()->value('current_price'); //get current cashew price
      //   $registered_found = explode('*',$request->USERDATA); //explode userdata into array
      //
      //   //user data is not empty
      //   if ($request->USERDATA != ""){
      //
      //     //handle farmer transaction calculation
      //     if($request->USERDATA != "" && session()->get("weight") == "filled"){
      //      $expected_payment = $this->ussd_price_compute($found_comm_price,$request->USERDATA);
      //      session()->flush("weight");
      //      return $this->data_tosend($request->MSISDN,$expected_payment,false);
      //    }else if($request->USERDATA == "1"){
      //         $response_one = "Enter total weight";
      //         session()->put("weight","filled");
      //         return $this->data_tosend($request->MSISDN,$response_one,true);
      //       }
      //
      //     // handle farmer sales data
      //     if($request->USERDATA == "2"){
      //       $sales_output = "";
      //       $farmer_sales_weight = Farmer_transaction::where('farmersfarmer_id',$exist_farmer_phone->farmer_id)->sum('total_weight');
      //       $farmer_sales_income = Farmer_transaction::where('farmersfarmer_id',$exist_farmer_phone->farmer_id)->sum('total_amount_paid');
      //       $sales_output .= "Sold ". $farmer_sales_weight . "kg for GHC " . $farmer_sales_income;
      //       return $this->data_tosend($request->MSISDN,$sales_output,false);
      //     }
      //
      //     //handle registered farmer checking other communities prices
      //     if ($request->USERDATA != "" && session()->get("price") == "filled" ){
      //         $get_community_name = $income_array[intval($request->USERDATA)-1];
      //         $got_price = $this->check_community_price($get_community_name);
      //         session()->flush("price");
      //         return $this->data_tosend($request->MSISDN,$got_price,false);
      //     }else if ($request->USERDATA == "3"){
      //       session()->put("price","filled");
      //       return $this->data_tosend($request->MSISDN,$this->ussd_outputs(), true);
      //     }
      //   }
      //
      //   return $this->data_tosend($request->MSISDN,$this->ussd_output($found_name, $community_name, $found_comm_price), true);
      // } else {
      //     //handle unregistered users
      //     $user_input = $request->USERDATA;
      //      if ($request->USERDATA != "" ){
      //         $cal = intval($request->USERDATA) - 1;
      //         $get_community_name = $income_array[$cal];
      //         $got_price = $this->check_community_price($get_community_name);
      //         return $this->data_tosend($request->MSISDN,$got_price,false);
      //     }
          return $this->data_tosend($request->MSISDN,$this->ussd_outputs($exist_farmer_phone), true);
      // }

    }

    //print farmer name and community price
    private function ussd_output($farmer_name, $community_name, $current_price){
        $display = "Welcome " . $farmer_name;
        $display .= "\n" . $community_name . " current price " . $current_price;
        $display .= "\n1.Calculate total sales\n2.Other communities";

        return $display;
    }

    // find all communities and associated prices
    private function ussd_outputs($yam){
      $display = "Select community\n";
      $display .= $yam;
      $count = 1;
      $communities = Community::all();
      foreach ($communities as $community) {
        $display .= $count . ". " . $community->community_name. "\n";
        //array_push($this->print_comm_array, $community->community_name);
        //add abbreviations to company names
        $count++;
      }

      return $display;
    }

    private function ussd_outputsarray(){
      $print_comm_array = array();
      $communities = Community::all();
      foreach ($communities as $community) {
        array_push($print_comm_array, $community->community_name);
      }

      return $print_comm_array;
    }

    //handle farmer price computation
    private function ussd_price_compute($total_weight, $current_price){
      return $total_weight * $current_price;
    }

    //check community and the price there
    private function check_community_price($name){
        $com_output = "";
        $community_id  = Community::where('community_name', $name)->value("community_id");
        $current_price  = Community_price::where('communitiescommunity_id', $community_id)->latest()->first();
        $com_output .= $current_price->community_name . " price per kilo is GHC " . $current_price->current_price;

        return $com_output;
    }

    // encode data to be sent back
    private function data_tosend($msisdn, $msg, $msg_type){
        $jsonresponse = [
          'USERID' => 'TTR_0025',
          'MSISDN' => '233'.$msisdn,
          'MSG' => $msg,
          'MSGTYPE' => $msg_type
        ];

       return json_encode($jsonresponse);
    }

}
