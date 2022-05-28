<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller


{
  public function index(){
    return OrderResource::collection(Order::all()); 
  }
  

    public function getOrdersClient(){
        $user = Auth::user();
        $orders =  Order::where('user_id',$user->id)->get();
          return OrderResource::collection($orders);
        }
  
        public function getOrdersVendor(){
          $user = Auth::user();
  
          // not done 
          $orders =  Order::where('user_id',$user->id)->get();
            return OrderResource::collection($orders);
          }
  
  
     
}
