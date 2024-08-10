<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(){
        return ('you created customer');
    }

    public function create(){
        return view('customers.create');
    }

    public function store(Request $reques){
        $data=$reques->validate([
            'fullname'=>'required',
            'email'=>'required',
            'phone'=>'required'
        ]);
        Customer::create($data);
        return redirect()->route('customers')->with('success', 'customer create successfully.');


    }
}




