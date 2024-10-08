<?php

namespace App\Http\Controllers;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class orderDetailController extends Controller
{ 

  public function store(Request $request){
    $data=$request->validate([
        'order_id'=>'required',
        'product_id'=>'required',
        'qty'=>'required',
        'price'=>'required',
        'total'=>'required'
    ]);
    
    $order=OrderDetail::create($data);

  }

    
}
