<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $service=Service::all();
        return view('service.index',compact('service'));
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


        $add=Service::create($data);
        return response()->json([
            'message' => 'Successfully created.',
        ]);


       }catch(\Exception $e){
        return response()->json([
            'message' => 'Error occurred: ' . $e->getMessage()
        ], 500);
      
       }
         
}

public function edit($id){
    $service=Service::find($id);

}

public function update(Request $request){
    $request->validate([
        'title'=>'required',
        'description'=>'required',
        'image'=>'nullable|image',
    ]);
   $service=Service::find($request->id);
   $service->title=$request->input('title');
   $service->description=$request->input('description');
   if ($request->hasFile('image')) {
    if ($service->image) {
        \Storage::disk('public')->delete($project->image);
    }
    $path = $request->file('image')->store('images', 'public');
    $service->image = $path;
}

$service->save();


}


}
