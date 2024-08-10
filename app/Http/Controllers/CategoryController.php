<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $category=Category::all();
        return view('category.index',compact('category'));
    }
   
 public function show($id){
    $product=Product::findOrFail($id);
    return view('products.show',compact('product'));
 }
public function store(Request $request)
{
    $data=$request->validate([
        'name'=> 'required|string'
    ]);
    Category::create($data);
    return redirect()->route('categories')->with('success','created category seccussfully.');
}
public function edit($id){
    $category=Category::findOrFail($id);
    return view('category.update',compact('category'));

}
public function update(Request $reques,$id){
    $data=$reques->validate([
        'name'=>'required'
    ]);
    $cat=Category::findOrFail($id);
    $cat->update($data);
    return redirect()->route('categories')->with('success', 'Category updated successfully.');

}




}
