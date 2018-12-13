<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmer;
use App\Farmer_transaction;

class farmerController extends Controller
{

    public static $print_comm_array;

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

    public function farmer_application_control(Request $request){
      $decoded_json = json_decode($request);
      $incoming_phone = $decoded_json->MSISDN;
      $found_name = "";
      $exist_farmer_phone = Farmer::where('phone_number', $incoming_phone)->first();

      if($exist_farmer_phone != null){
        $found_name = $exist_farmer_phone->first_name . " " . $exist_farmer_phone->other_name . " " . $exist_farmer_phone->last_name;
        $community_name = Community::where("community_id", $exist_farmer_phone->communitiescommunity_id)->value("community_name");
        $found_comm_price = Community_price::where('communitiescommunity_id', $exist_farmer_phone->communitiescommunity_id)->latest()->value('current_price');
        $registered_found = explode('*',$decoded_json->USERDATA);
        if ($request->USERDATA != ""){
          if($registered_found[0] == "1" && $registered_found[1] != ""){
           $expected_payment = $this->ussd_price_compute($found_comm_price,$registered_found[1]);
           return $this->data_tosend($decoded_json->MSISDN,$expected_payment,false);
         }else if($registered_found[0] == "1"){
              $response_one = "Enter total weight";
              return $this->data_tosend($decoded_json->MSISDN,$response_one,true);
            }

          if($registered_found[0] == "2"){
            $sales_output = "";
            $farmer_sales_weight = Farmer_transaction::where('farmersfarmer_id',$exist_farmer_phone->farmer_id)->sum('total_weight');
            $farmer_sales_income = Farmer_transaction::where('farmersfarmer_id',$exist_farmer_phone->farmer_id)->sum('total_amount_paid');
            $sales_output .= "Sold ". $farmer_sales_weight . "kg for GHC " . $farmer_sales_income;
            return $this->data_tosend($decoded_json->MSISDN,$sales_output,false);
          }

          if ($exploded_data[0] == nl && $exploded_data[1] != null ){
              $get_community_name = $print_comm_array[$exploded_data[1]];
              $got_price = $this->check_community_price($get_community_name);
              return $this->data_tosend($decoded_json->MSISDN,$got_price,false);
          }else if ($registered_found[0] == "3"){
            return $this->data_tosend($decoded_json->MSISDN,ussd_output(), true);
          }
        }

        return $this->data_tosend($decoded_json->MSISDN,ussd_output($found_name, $community_name, $found_comm_price), true);
      } else {
          $user_input = $decoded_json->USERDATA;
          $exploded_data = explode('*', $user_input);
          if($exploded_data[0] != null ){
              return $this->data_tosend($decoded_json->MSISDN,ussd_output(), true);
          } else if ($exploded_data[0] != null && $exploded_data[1] != null ){
              $get_community_name = $print_comm_array[$exploded_data[1]];
              $got_price = $this->check_community_price($get_community_name);
              return $this->data_tosend($decoded_json->MSISDN,$got_price,false);
          }
          return $this->data_tosend($decoded_json->MSISDN,ussd_output(), true);
      }

    }

    private function ussd_output($farmer_name, $community_name, $current_price){
        $display = "Welcome " . $farmer_name;
        $display .= "\n" . $community_name . " current price " . $current_price;
        $display .= "\n1.Calculate total sales\n2.Other communities";

        return $display;
    }

    private function ussd_output(){
      $display = "Select community\n";
      $count = 1;
      $communities = Community::all()->get();
      foreach ($communities as $community) {
        $display .= $count . ". " . $community->community_name. "\n";
        array_push($print_comm_array, $community->community_name);
        //add abbreviations to company names
        $count++;
      }

      return $display;
    }

    private function ussd_price_compute($total_weight, $current_price){
      return $total_weight * $current_price;
    }

    private function check_community_price($name){
        $com_output = "";
        $community_id  = Community::where('community_name', $name)->value("community_id");
        $current_price  = Community_price::where('communitiescommunity_id', $community_id)->latest()->first();
        $com_output .= $current_price->community_name . " price per kilo is GHC " . $current_price->current_price;

        return $com_output;
    }

    private function data_tosend($msisdn, $msg, $msg_type){
        $jsonresponse = [
          'USERID' => '',
          'MSISDN' => $msisdn,
          'MSG' => $msg,
          'MSGTYPE' => $msg_type
        ];

       return json_econde($jsonresponse);
    }
}
