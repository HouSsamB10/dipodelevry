<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_category',
        'URL_image',
    ];


    public function product(){
        return $this->hasMany(Product::class);
    }
    
}
