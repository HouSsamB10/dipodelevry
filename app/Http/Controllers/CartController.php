<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
   
    public function index(){
        $user = Auth::user();
        $cart = Cart::where('user_id',$user->id)->first();
      
        if(is_null($cart )){
          return 0;
        }
        // calcul total price not done
        $carts = Cart::where('user_id',$user->id)->get();
        $total=0; 
        foreach($carts as $cart ){
         $total = $cart->total + $total;
         }
   
         $response = [
           'cart_items' =>  CartResource::collection($carts),
           'total' => $total,
       ];
   
       return response($response, 201);
      }
   
     public function addProductToCart(Request $request){
      
       $request->validate([
         'product_id' => 'required',
     ]);
       
       $user = Auth::user();
     
       $carts = Cart::where('user_id',$user->id)->get();
       $Product = Product::find((int) $request->get('product_id'));
 
   
   
       for( $i= 0; $i < count($carts); $i++ ){
       
        if($request->get('product_id') == $carts[$i]->product_id ){
         $carts[$i]->quantity = $carts[$i]->quantity +1 ;
           $product = Product::find($carts[$i]->product_id); 
           $carts[$i]->total = $product->sale_price * $carts[$i]->quantity;
   
           $carts[$i]->save();
           return new CartResource($carts[$i]);
        }
       }
   
       
       $cart1 = new Cart();
   
       $cart1->product_id = (int) $request->get('product_id');
       $cart1->user_id = $user->id;
       $cart1->save();
       $cart = Cart::find($cart1->id);
       
       $product1 = Product::find($cart->product_id);
        
       $cart->total = $product1->sale_price * $cart->quantity;
       $cart->save();
       return new CartResource($cart); 
      
      }
   
      public function removeProductToCart($id){
       $cart = Cart::find($id);
     
       if( $cart->quantity == 1){
         return Cart::destroy($id);
       }
       $cart->quantity = $cart->quantity - 1 ;
       $cart->save();
       return  new CartResource($cart); 
      }
   
      public function removeAllProductToCart(){
       $user = Auth::user();
       $carts = Cart::where('user_id',$user->id)->get();
   
       foreach(  $carts as $cartDestory){
         
        Cart::destroy($cartDestory->id);
        }
     
     }
   
   
     public function makeOrder(){
       $user = Auth::user();
   
       $carts = Cart::where('user_id',$user->id)->get();
       if(is_null($carts[0] )){
         $response = [
           'message' => ' we don\'t have carts',
       ];
   
       return response($response, 201);
       }
       
       $order = new Order();
       $order->user_id = $user->id;
      // $order->status = \App\Enums\orderTypes::PENDING->value;
       $product = Product::find($carts[0]->product_id);
      
     
       $total=0; 
       foreach($carts as $cart ){
        $total = $cart->total + $total;
        } 
       $order->price = $total;
       $order->save();
       
       foreach ($carts as $cart){
         $orderItem = new OrderItem();
         $orderItem->order_id = $order->id ; 
         $orderItem->product_id =$cart->product_id ; 
         $orderItem->quantity = $cart->quantity  ;
         $orderItem->price = 0;
         $orderItem->total = $cart->total ;
         $orderItem->save();
       }
       foreach(  $carts as $cartDestory){
         
         Cart::destroy($cartDestory->id);
         }
       return  new OrderResource($order);
     }
}
