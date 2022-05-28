<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request) {
        $request->validate([
          'category' => 'required|string',
          'category_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                 ]);
    
                 $category = new Category();
                 $category->category = $request->get('category');
                 // upload image of user 
                 
                 if($request->hasFile('category_url')) {
                  $file_extension = $request->category_url->getClientOriginalExtension();
                  $file_name = time().'.'.$file_extension;
                  $path = 'images/categories';
                  $request->category_url->move($path, $file_name);
          
                  $category->category_url = $file_name;
          
                }
                 $category->save();
           
      $response = [
          'category' => $category,
      ];

      return response($response, 201);
  }

  public function delete($id){
    return Category::destroy($id);
   }

   public function getbyid($id){
    return Category::with(['products',])->find($id);
   }
// not done
   public function getProdcutsWithShopsbyCategory($id){
    return new CategoryResource(Category::where('id' ,$id)->first());
   }


   public function createCategories(){

    $listCategories = ['hamoud', 'coca' , 'vitajuice'];
    
    foreach($listCategories as $r ){
     
      $category = new Category();
      $category->name_category = $r; 
      $category->URL_image = 'https://www.hamoud-boualem.com/media/k2/items/cache/e31ace2a15a7c70645ad83df9ecd43b0_M.png'; 
   

      $category->save();
    }
    
      return  [
         'categories are created'
      ];
  
    } 
}
