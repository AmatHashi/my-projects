<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $project=Project::all();
        return view('project.index',compact('project'));
    }
   
    public function store(Request $request){

       try{
        $data = $request->validate([
            'name'=>'required',
            'description' => 'required',
            'image'=>'nullable',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $fileName = $image->getClientOriginalName(); 
            $path = $image->storeAs('uploads', $fileName, 'public');

            $data['image'] = $path; 
        }


        $add=Project::create($data);
        // return response()->json([
        //     'message' => 'Successfully created.',
        // ]);


       }catch(\Exception $e){
        return response()->json([
            'message' => 'Error occurred: ' . $e->getMessage()
        ], 500);
      
       }
         
     }
    public function edit($id) {
    $product = Project::find($id); 

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    return response()->json($product);
    }


  public function modify(Request $request)
  {
    $request->validate([
        'id' => 'required|integer|exists:projects,id',
        'name' => 'required|string',
        'description' => 'required',
        'image' => 'nullable', 
    ]);

    $project = Project::findOrFail($request->id);

    $project->name = $request->input('name');
    $project->description = $request->input('description');

    if ($request->hasFile('image')) {
        if ($project->image) {
            \Storage::disk('public')->delete($project->image);
        }
        $path = $request->file('image')->store('images', 'public');
        $project->image = $path;
    }

    $project->save();

    return response()->json(['message' => 'Project updated successfully!']);
   }

  public function delete($id)
 {
    $project = Project::findOrFail($id);
    if ($project->image) {
        \Storage::disk('public')->delete($project->image);
    }
    $project->delete();
    return response()->json(['message' => 'Project deleted successfully!']);
} 

}
