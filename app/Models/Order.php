<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

  public $fillable=[
    'cus_id',
    'status',
    'total'
  ]
     public function detail()
    {
        return $this->hasMany(OrderDetail::class,'order_id');
    }

}
