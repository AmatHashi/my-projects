<?php

namespace App\Http\Controllers;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class orderDetailController extends Controller
{
    public function index(){
        return ('you create orderdetail');
    }
  public function create(){
    return view('orderdetail.create');

  }  

  public function store(Request $request){
    $data=$request->validate([
        'order_id'=>'required',
        'product'=>'required',
        'qty'=>'required',
        'unitprice'=>'required',
        'total'=>'required'
    ]);
    
    $order=OrderDetail::create($data);
    return redirect()->route('details')->with('success', 'orderdetail create successfully.');

  }

    
}
