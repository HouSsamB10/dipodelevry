<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'total_of_product',
        'discount',
        'URL_image',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }

    public function orderItems(){
        return $this->hasOne(OrderItem::class);
    }

}
