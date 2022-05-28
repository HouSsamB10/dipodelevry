<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index(){

        return OrderItem::all();
      }


    public function store(Request $request) {
        $request->validate([
          'order_id' => 'required',
          'product_id' => 'required',
          'quantity' => 'required',
          'price' => 'required',
          'total' => 'required',
                 ]);
    
                 $cartItem = new OrderItem();
                 $cartItem->order_id = $request->get('order_id');
                 $cartItem->product_id = $request->get('product_id');
                 $cartItem->quantity = $request->get('quantity');
                 $cartItem->price = $request->get('price');
                 $cartItem->total = $request->get('total');

                 $cartItem->save();
      $response = [
          'cartItem' => $cartItem,

      ];

      return response($response, 201);
  }

  public function getbyid($id){
    return OrderItem::find($id);
   }

   public function delete($id){
    return OrderItem::destroy($id);
   }
}
