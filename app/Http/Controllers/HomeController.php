<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    

    function index(){
        $products = Product::get();
        $category = Category::get();
        return view('layouts.home',compact('products','category')); 
    }
    function contact(){
        return view('layouts.cantact')
    }
  
}
