<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use  Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerL(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'adress' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            
        ]);

      
        $user = new User();
        $user->name = $request->get('name');
        $user->phone_number = $request->get('phone_number');
        $user->adress = $request->get('adress');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->is_online = 0;
        $user->role_id = 3;
        // upload image of user 
      /*  
        if($request->hasFile('avatar_url')) {
         $file_extension = $request->avatar_url->getClientOriginalExtension();
         $file_name = time().'.'.$file_extension;
         $path = 'images/users';
         $request->avatar_url->move($path, $file_name);
 
         $user->avatar_url = $file_name;
       }
       */
        $user->save();
      

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }



    public function registerA(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'adress' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            
        ]);

      
        $user = new User();
        $user->name = $request->get('name');
        $user->phone_number = $request->get('phone_number');
        $user->adress = $request->get('adress');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->is_online = 0;
        $user->role_id = 2;
        // upload image of user 
      /*  
        if($request->hasFile('avatar_url')) {
         $file_extension = $request->avatar_url->getClientOriginalExtension();
         $file_name = time().'.'.$file_extension;
         $path = 'images/users';
         $request->avatar_url->move($path, $file_name);
 
         $user->avatar_url = $file_name;
       }
       */
        $user->save();
      

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

 
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'adress' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            
        ]);

      
        $user = new User();
        $user->name = $request->get('name');
        $user->phone_number = $request->get('phone_number');
        $user->adress = $request->get('adress');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->is_online = 0;
        $user->role_id = 1;
        // upload image of user 
      /*  
        if($request->hasFile('avatar_url')) {
         $file_extension = $request->avatar_url->getClientOriginalExtension();
         $file_name = time().'.'.$file_extension;
         $path = 'images/users';
         $request->avatar_url->move($path, $file_name);
 
         $user->avatar_url = $file_name;
       }
       */
        $user->save();
      

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
       // dd($request);
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
     
        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !($fields['password'] == $user->password) ) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

}
