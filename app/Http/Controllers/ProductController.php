<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Favorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{ 
    public function index()
  {
    $products = Product::with('mycat')->get(); 
    $category = Category::all(); 

    return view('products.index', compact('products','category' ));
  }
    
    
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'quantity' => 'required|string',
                'discription' => 'required|string',
                'image' => 'required|image',
                'price' => 'required',
                'cat_id' => 'required',
            ]);
    
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $data['image'] = $filePath; 
            }
    
            Product::create($data);
    
        return redirect()->route('products')->with('success', 'Product created successfully.');
        }catch (\Exception $e) {
            \Log::error('Error creating product: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'There was an error creating the product: ' . $e->getMessage());
        }
    
    }


    public function show($id){
        $product=Product::findOrFail($id);
            Favorate::create([
                'product_id' => $id,
            ]);
         return view('products.show',compact('product'));
     }


    public function edit($id){
        $product = Product::findOrFail($id); 
        return response()->json($product); 

        return view('products.update',compact('product'));
    }

   
   
    public function update(Request $request, $id)
   {
    $validatedData = $request->validate([
        'name' => 'required',
        'quantity' => 'required',
        // 'discription' => 'required',
        'price' => 'required',
        // 'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
    ]);

    $product = Product::findOrFail($id);

    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');
        $validatedData['image'] = $filePath;
    } else {
        $validatedData['image'] = $product->image;
    }

    $product->update($validatedData);

    return redirect()->route('products')->with('success', 'Product updated successfully.');
   }

   public  function delete($id){
    Product::where('id',$id)->delete();
    return redirect()->route('products' )->with('success', ' delete successfully.');

  }

     function detail($id){
        $product=Product::findOrFail($id);

        Favorate::create([
            'product_id' => $id,
        ]);
        
        return view('layouts.ItemDetail',compact('product')); 
    }
   

    // public function cart(Request $request)
    // {
    //     if ($request->isMethod("get")) {

    //         return view('layouts.cart'); 
    //         dd($request);
    //     }elseif($request->isMethod("get")){
    //         dd($request);
    //     } 
      // $products = [];

        // foreach ($productIds as $id) {
            
                // $products[] = $product;       
    // }    
    // }

//     public function cartDetails(Request $request){
//     $validated = $request->validate([
//         'productid' => 'required',
//         'productid.*' => 'integer|exists:products,id',
//     ]);
//     $productIds = $validated['productid'];
//     $products = Product::whereIn('id', $productIds)->get();
//     return response()->json([
//         'status' => 200,
//         'products' => $products
//     ]);
//  }

  public function showCartView(Request $request){
    $data = $request->validate([
        'productid' => 'required|array',
        'productid.*' => 'required|integer|exists:products,id',
    ]);

    $productIds = $data['productid'];
    $products = Product::whereIn('id', $productIds )->get();
    return view('layouts.cart', compact('products'));
   
   }

  }
//  public function update(Request $request, $id)
//     {
//         $user = User::find($id);
//         if ($user) {
//             $user->update($request->all());
//             return response()->json($user);
//         }
//         return response()->json(['error' => 'User not found'], 404);
//     }