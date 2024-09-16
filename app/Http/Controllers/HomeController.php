<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\SlideShow;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    

    function index(){
        $newArrivals = Product::where('created_at', '>=', now()->subMonth())
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();
        $slide=SlideShow::all();


        // $categories = Category::with('products')->get();
        // $category = Category::with(['products' => function($query) {
        //     $query; 
        // }])->get();   
  
    $topFavProducts = Product::select('products.*')
    ->leftJoin('favorates', 'products.id', '=', 'favorates.product_id')
    ->selectRaw('COUNT(favorates.id) as favorites_count')
    ->groupBy('products.id')
    ->orderBy('favorites_count', 'desc')
    ->limit(4)
    ->get();
     
        return view('layouts.home',compact('newArrivals','topFavProducts','slide')); 
    }
    function contact(){
        return view('layouts.cantact');
    }

    public function createMessage(Request $request){

       try{


        $data=$request->validate([
            'name'=>  'required',
            'email'=> 'required',
            'subject'=>'required',
            'message'=>'required'

        ]);
     $store=Contact::create($data);

     return response()->json([
    'message'=>'seccess fully create',
    'contact'=> $store

     ]);

   }catch (\Exception $e) {
    return response()->json([
        'message' => 'Error occurred: ' . $e->getMessage()
    ], 500);

    }

    }
    public function findAllContact(){
    $contact= Contact::all();
    return view('contacts.index', compact('contact'));
    }

    function about(){
        return view('layouts.about');
     }
    function collection(){
        $categories = Category::with('products')->get();

        return view('layouts.collection',compact('categories'));
    }

    public function createform(){
        return view('layouts.slideshow');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
      

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $data['image'] = $filePath;
        }
        $slide = SlideShow::create($data);

    
        return back()->with('success', 'Slide added successfully!');
    }
    
    
  

}
