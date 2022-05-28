<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register' , 'App\Http\Controllers\AuthController@register');

Route::post('registerAdmin' , 'App\Http\Controllers\AuthController@registerA');//done



Route::post('login' , 'App\Http\Controllers\AuthController@login');//done

Route::post('roles' , 'App\Http\Controllers\RoleController@createRoles');//done
Route::post('categories' , 'App\Http\Controllers\CategoryController@createCategories'); //done
Route::get('products' , 'App\Http\Controllers\ProductController@index'); // done
Route::post('search' , 'App\Http\Controllers\ProductController@search'); // done
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group([
         'prefix' => 'admin',
         'middleware' => 'is_admin',
     ],function(){
     // routes of admin
     Route::post('logout' , 'App\Http\Controllers\AuthController@logout');//done
     Route::post('product' , 'App\Http\Controllers\ProductController@store');//done
     Route::post('product/{id}' , 'App\Http\Controllers\ProductController@update'); // done
     Route::post('registerLivreur' , 'App\Http\Controllers\AuthController@registerL');//done
     Route::get('allorders','App\Http\Controllers\OrderController@index'); 
    });

     
     Route::group([
        'prefix' => 'delevry',
        'middleware' => 'is_delevry',
    ],function(){
        // routes of delevry
    
     
    });

    Route::group([
        'prefix' => 'client',
        'middleware' => 'is_client',
    ],function(){
        // routes of client
      
        Route::post('logout','App\Http\Controllers\AuthController@logout');// done
        // cart :
        Route::post('addProductToCart','App\Http\Controllers\CartController@addProductToCart'); //done
        Route::post('removeProductToCart/{id}','App\Http\Controllers\CartController@removeProductToCart'); // done
        Route::post('removeAllProductToCart','App\Http\Controllers\CartController@removeAllProductToCart'); // done
        Route::get('carts','App\Http\Controllers\CartController@index'); // done
  
        // order : 
        Route::get('orders','App\Http\Controllers\OrderController@getOrdersClient'); // done
        Route::post('makeOrder','App\Http\Controllers\CartController@makeOrder'); // done
        
        // user :
        Route::post('user','App\Http\Controllers\UserController@update'); // done
        Route::get('user','App\Http\Controllers\UserController@getbyid'); // done

    });

    

  });




