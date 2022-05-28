<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
   
    public function index(){
        return ProductResource::collection(Product::paginate(15));
      } 


    public function store(Request $request) {
 
        $request->validate([
          'title' => 'required|string',
          'description' => 'required|string',
          'price' => 'required',
          'total_of_product' => 'required',
          'discount' => 'required',
          'category_id' => 'required',
                 ]);

                 $user = Auth::user();
               //  $shop = Shop::where('user_id' , $user->id)->first();
               
                 $product = new Product();
                 $product->title = $request->get('title');
                 $product->description = $request->get('description');
                 $product->price = $request->get('price');
                 $product->total_of_product = $request->get('total_of_product');
                 $product->discount = $request->get('discount');
                 $product->category_id = $request->get('category_id');
                 $product->URL_image = 'https://www.hamoud-boualem.com/media/k2/items/cache/e31ace2a15a7c70645ad83df9ecd43b0_M.png';
                 $product->user_id = $user->id; 
               // $product->shop_id = $shop->id;
                
                 $product->save();
                 


/*
                 if( $request->hasFile('image')){
                  $imageModel = new Image();

                  $file_extension = $request->image->getClientOriginalExtension();
                  $file_name = time().'.'.$file_extension;
                  $path = 'images/products';
                  $request->image->move($path, $file_name);       
                  $imageModel->image_url = $file_name;
                  $imageModel->product_id= $product->id;
                  $imageModel->save();
                 }
                */
      return new ProductResource($product);
  }


  public function update(Request $request,$id) {
    $user = Auth::user();
  //  $shop =  Shop::where('user_id',$user->id)->first();
    
    $product = Product::find($id);
   

  
    if( $request->has('title')   ){
      $product->title = $request->get('title');
   }
   if( $request->has('description')   ){
      $product->description = $request->get('description');
   }

   if( $request->has('price')   ){
    $product->price = (Double) $request->get('price');
 }

   if( $request->has('total_of_product')   ){
    $product->total_of_product = (int) $request->get('total_of_product');
 }

if( $request->has('discount')   ){
  $product->discount = (Double) $request->get('discount');
}
if( $request->has('category_id')   ){
  $product->category_id = (int) $request->get('category_id');
}


    $product->save();
  /*
    if( $request->hasFile('image')){
     
      $imageModel = Image::find($request->get('image_id'));
    
      $file_extension = $request->image->getClientOriginalExtension();
    
      $file_name = time().'.'.$file_extension;
     
      $path = 'images/products';
   
      $request->image->move($path, $file_name);       
      $imageModel->image_url = $file_name;
      $imageModel->product_id= $product->id;
     
      $imageModel->save();
      
     }

*/

  return new ProductResource($product);
}

  public function getbyid($id){

   $product =   Product::find($id);
   
    return new ProductResource($product);
   }


   public function delete($id){

    $user = Auth::user();
  //  $shop =  Shop::where('user_id',$user->id)->first();
    
    $product = Product::find($id);
   
    

    return Product::destroy($id);
   }

   public function search(Request $request){
     $request->validate([
       'search' => 'required',
     ]);
     $product =  Product::where('title', 'LIKE',  $request->search . '%')->get();
    
     return  ProductResource::collection($product);
}

}
