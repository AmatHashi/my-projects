<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\User;
use App\Models\Category;
use App\Models\Favorate;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_id',
        'name',
        'image',
        'quantity',
        'discription',
        'price'
    ];
  

    public function mycat (){
        return $this->belongsTo(Category::class,'cat_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorate::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
