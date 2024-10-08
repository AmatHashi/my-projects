<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Introduction;
use Illuminate\Http\Request;

class AboutController extends Controller
{


    public function edit()
    {
        // $about = About::where('id', $id)->get(); 
        $about = About::all(); 
        return view('about.index',compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:abouts,id', 
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image', 
        ]);
        $id = $request->input('id');

        $about = About::findOrFail($id);

       $about->title = $request->input('title');
        $about->description = $request->input('description');

       if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $about->image = $path; 
        }

        $about->save();
        return response()->json(['message' => 'Updated successfully!'] );


    }

    

    public function store(Request $request){

       try{
        $data = $request->validate([
            'title'=>'required',
            'description' => 'required',
            'image'=>'nullable',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $fileName = $image->getClientOriginalName(); 
            $path = $image->storeAs('uploads', $fileName, 'public');

            $data['image'] = $path; 
        }


        $add=About::create($data);
        return response()->json([
            'message' => 'Successfully created.',
            'about' => $add
        ]);


       }catch(\Exception $e){
        return response()->json([
            'message' => 'Error occurred: ' . $e->getMessage()
        ], 500);
      
       }
         
}

public function hero(){
    $introduction = Introduction::all();

    return view('about.hero',compact('introduction'));
}
public function modify(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:introductions,id', 
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'name' => 'required', 
    ]);
    $id = $request->input('id');

    $intro = Introduction::findOrFail($id);

   $intro->title = $request->input('title');
   $intro->name = $request->input('name');
    $intro->description = $request->input('description');


    $intro->save();
    return response()->json(['message' => 'Updated successfully!'] );


}

public function add(Request $request){

   try{
    $data = $request->validate([
        'title'=>'required',
        'description' => 'required',
        'name'=>'required',
    ]);
    


    $add=Introduction::create($data);
    return response()->json([
        'message' => 'Successfully created.',
    ]);


   }catch(\Exception $e){
    return response()->json([
        'message' => 'Error occurred: ' . $e->getMessage()
    ], 500);
  
   }
     
}
       
}