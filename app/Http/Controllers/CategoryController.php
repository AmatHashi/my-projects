<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $data['category']=Category::all();
        return view('category.index',$data);
}
public function store(Request $request)
{
    $data=$request->validate([
        'name'=> 'required|string'
    ]);
    Category::create($data);
    return redirect()->route('category.index')->with('success','created category seccussfully.');
}
public function edit($id)
{
    try {
        $category = Category::find($id);

        if ($category) {
            return response()->json($category); 
        } else {
            return response()->json(['error' => 'Category not found.'], 404); 
        }
    } catch (\Exception $e) {
        Log::error('Error fetching category: ' . $e->getMessage());
        return response()->json(['error' => 'An error occurred.'], 500);
    }
}


public function update(Request $request){
    $category = Category::find($request?->id);
    $category->name = $request->name;
    $category->save();
    return response('updated successfully.');
}

public  function delete($id){
    Category::where('id',$id)->delete();
    return redirect()->route('category.index' )->with('success', ' delete successfully.');
}

}
