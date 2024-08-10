<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;
    public $fillable=[
        'order_id',
        'product_id',
        'qty',
        'unitprice',
        'total'
    ];

       public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    {
        return $this->belongsTo(Product::class);
    }
}
