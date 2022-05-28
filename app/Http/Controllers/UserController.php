<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    { 
     
        return User::all();
    }

     
   public function store(Request $request){
    $request->validate([
        'name' => 'required',  
        'email' => 'required',  
        'password' => 'required',  
    ]);
      $user =   User::create($request->all());

      return $user;
}

    

public function getbyid(){

    $user = Auth::user(); 
  
    return new UserResource($user);
   }
   
  
   public function update(Request $request ){
    $user = Auth::user();
     
   
    if( $request->has('name')   ){
      $user->name = $request->get('name');

   }
   if( $request->has('phone_number')   ){
    $user->phone_number = $request->get('phone_number');

 }
 if( $request->has('adress')   ){
  $user->adress = $request->get('adress');

}
if( $request->has('email')   ){
  $user->email = $request->get('email');

}
if( $request->has('password')   ){
  $user->password = $request->get('password');

}   
if( $request->has('URL_image')   ){
    $user->URL_image = $request->get('URL_image');
  
  }
  if( $request->has('is_online')   ){
    $user->is_online = $request->get('is_online');
  
  }   

    $user->save();
return new UserResource($user);
}

   public function destroy($id)
   {
       return User::destroy($id);
   }

}
