<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorate extends Model
{
    use HasFactory;


    public $fillable=[
        'product_id'
    ];
    public function products()
    {
        return $this->belongsTo(Product::class);
    }

}
