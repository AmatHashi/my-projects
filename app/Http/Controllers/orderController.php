<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function index(){
        return view('orders.index');
    }
  public function create(){
    return view('orders.create');

  }  

  public function store(Request $request){
    $data=$request->validate([
        'cus_id'=>'required',
        'status'=>'required',
        'total'=>'required'
    ]);
    
    $order=Order::create($data);
    return redirect()->route('orders')->with('success', 'orders create successfully.');

  }

}
