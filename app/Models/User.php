<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone_number',
        'adress',
        'email',
        'email_verified',
        'password',
        'URL_image',
        'is_online'
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function shipment(){
        return $this->hasMany(Shipment::class);
    }
}
