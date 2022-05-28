<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
       
    public function index(){

        return Role::all();  
      }

      public function getbyid($id){

         return Role::find($id);  
       }

     public function store(Request $request){
 

               $request->validate([
              'role' => 'required',
                   ]);

            $role = new Role();
            $role->role = $request->get('role');   
            $role->save();
               return $role;    

     }
/*
     public function update(Request $request, $id){

     $role =  Role::find($id);

  if ($request->has('role')  ){
    $role->role = $request->get('role');   
  }
    
     $role->save();
        return $role;    

}
*/


public function createRoles(){

$listRoles = ['client', 'admin' , 'livreur'];

foreach($listRoles as $r ){
 
  $role = new Role();
  $role->name_role = $r; 
 
  $role->save();
   
}

  return  [
     'roles are created'
  ];


} 

}
