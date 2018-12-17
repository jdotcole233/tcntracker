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

  public function farmerapplicationcontrol(Request $request){
    $incoming_phone = $request->MSISDN;
    $found_name = "";
    $exist_farmer_phone = Farmer::where('phone_number',  $request->MSISDN)->first();

    return $this->data_tosend($request->MSISDN,$this->ussd_outputs($exist_farmer_phone->first_name), true);
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
    $display .= $yam ."\n";
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
