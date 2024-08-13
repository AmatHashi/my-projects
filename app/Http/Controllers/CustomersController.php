<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(){
        $customer=Customer::all();

        return view('customers.index',compact('customer'));
    }

  

    public function store(Request $reques){
        $data=$reques->validate([
            'fullname'=>'required',
            'email'=>'required',
            'phone'=>'required'
        ]);
        Customer::create($data);
    }

    public function edit($id){
        $customer=Customer::findOrFail($id);

    }

    public function update(Request $reques){
        $data=$reques->validate([
            'fullname'=>'required',
            'email'=>'required',
            'phone'=>'required',
        ]);

        $customer->update($data);


    }
}




