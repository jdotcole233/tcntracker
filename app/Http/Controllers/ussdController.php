<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmer;
use App\Farmer_transaction;
use App\Community;
use App\Community_price;

class ussdController extends Controller
{
  //Famer ussd controls
  self::$boolean_check = false;

  public function farmerapplicationcontrol(Request $request){
    $incoming_phone = $request->MSISDN;
    $found_name = "";
    $exist_farmer_phone = Farmer::where('phone_number',  $request->MSISDN)->first();

    if ($exist_farmer_phone != null){
      $found_name .= $exist_farmer_phone->first_name . " " . $exist_farmer_phone->other_name . " " . $exist_farmer_phone->last_name; //get farmer name
      $community_name = Community::where("community_id", $exist_farmer_phone->communitiescommunity_id)->value("community_name"); //get community name
      $found_comm_price = Community_price::where('communitiescommunity_id', $exist_farmer_phone->communitiescommunity_id)->latest()->value('current_price'); //get current cashew price

      if ($request->USERDATA != null){
        //calculate farmer sale
        if ($request->USERDATA == "1"){
          self::$boolean_check = true;
          $response_one = "Enter total weight";
          return $this->data_tosend($request->MSISDN,$response_one,true);
        } else if (sel::$boolean_check){
          $expected_payment = $this->ussd_price_compute($found_comm_price,$request->USERDATA);
          return $this->data_tosend($request->MSISDN,$expected_payment,false);
        }

          //query sales data
          if($request->USERDATA == "2"){
            $sales_output = "";
            $farmer_sales_weight = Farmer_transaction::where('farmersfarmer_id',$exist_farmer_phone->farmer_id)->sum('total_weight');
            $farmer_sales_income = Farmer_transaction::where('farmersfarmer_id',$exist_farmer_phone->farmer_id)->sum('total_amount_paid');
            $sales_output .= "Sold ". $farmer_sales_weight . "kg for GHC " . $farmer_sales_income;
            return $this->data_tosend($request->MSISDN,$sales_output,false);
          }

          //viewing other communities
          if($request->USERDATA == "3"){
            return $this->data_tosend($request->MSISDN,$this->ussd_outputs(), false);
          }

        return $this->data_tosend($request->MSISDN,$this->ussd_output($found_name, $community_name, $found_comm_price), true);
      } else{

        return $this->data_tosend($request->MSISDN,$this->ussd_outputs(), true);
      }
    } else{
      return $this->data_tosend($request->MSISDN,$this->ussd_outputs(), false);
    }
  }

  //print farmer name and community price
  private function ussd_output($farmer_name, $community_name, $current_price){
      $display = "Welcome to TON TRACKER\n" . $farmer_name;
      $display .= "\n" . $community_name . " price: " . $current_price;
      $display .= "\n1. Calculate total sales\n2. Sales data \n3. Other communities";

      return $display;
  }

  // find all communities and associated prices
  private function ussd_outputs(){
    $display = "Welcome to TON TRACKER\nCommunity price list\n";
    $count = 1;
    $communities = Community::all();
    /*
    *@alternative: join communities table with community prices
    *@todo: add abbreviations to company names
    */
    foreach ($communities as $community) {
      $community_id  = Community::where('community_name', $community->community_name)->value("community_id");
      $current_price  = Community_price::where('communitiescommunity_id', $community_id)->latest()->first();
      $display .= $count . ". " . $community->community_name. " - price: " . $current_price->current_price ."\n";
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
