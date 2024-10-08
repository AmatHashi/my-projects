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
    
//   public function store(Request $request)
//   {
//       try {
//           $data = $request->validate([
//               'name' => 'required|string',
//               'discription' => 'required|string',
//               'image' => 'nullable|image', 
//               'price' => 'required|numeric',
//               'cat_id' => 'required|integer',
//               'sizes' => 'nullable|array', 
//               'colors' => 'nullable|array', 
//           ]);
  
//           if ($request->hasFile('image')) {
//               $file = $request->file('image');
//               $fileName = time() . '_' . $file->getClientOriginalName();
//               $filePath = $file->storeAs('uploads', $fileName, 'public');
//               $data['image'] = $filePath;
//           }
  
         
  
//           $product = Product::create($data);
  
//           return response()->json([
//               'message' => 'Successfully created.',
//               'product' => $product
//           ]);
//       } catch (\Exception $e) {
//           \Log::error('Error creating product: ' . $e->getMessage());
//           return response()->json([
//               'message' => 'Operation failed',
//               'error' => $e->getMessage()
//           ], 500);
//       }
//   }
  
  // hi
  public function store(Request $request)
{
    try {
        $data = $request->validate([
            'name' => 'required|string',
            'discription' => 'required|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'cat_id' => 'required|integer',
            'sizes' => 'nullable|array',
            'colors' => 'nullable|array',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $imagePaths[] = $filePath;
            }
        }

        $data['image'] = json_encode($imagePaths); 

        $product = Product::create($data);

        return response()->json([
            'message' => 'Successfully created.',
            'product' => $product
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error occurred: ' . $e->getMessage()
        ], 500);
    }
}




    public  function edit(Request $request){   
    $product = Product::where('id', $request?->id)->first();
    if (!$product) {
        return response('Product not found', 404);
    }else{
        return $product; 
    }
    }
    public function update(Request $request, ) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'discription' => 'nullable|string',
            'price' => 'required|numeric',
            'cat_id' => 'nullable|exists:categories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'sizes' => 'nullable|array',
            'sizes.*' => 'string|in:S,M,L,XL', 
            'colors' => 'nullable|array',
            'colors.*' => 'string|in:Blue,Red,Green,Black,White',
        ]);
    
        $product = Product::findOrFail($request->id);
    
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $validatedData['image'] = $filePath;
        }
    
        $product->update($validatedData);
    
        return response()->json(['success' => 'Product updated successfully']);
    }
    
    
        public  function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('products.index' )->with('success', ' delete successfully.');
           }

       public function show($id){
       $product=Product::findOrFail($id);
       Favorate::create([
            'product_id' => $id,
           ]);
        return view('products.show',compact('product'));
        }

     public function detail($id){
        $product=Product::findOrFail($id);
        $category = $product->cat_id;        
        $relatedProducts = Product::where('cat_id', $category)
            ->where('id', '<>', $id) 
            ->get();
        Favorate::create([
            'product_id' => $id,
        ]);
        
        return view('layouts.ItemDetail',compact('product','relatedProducts')); 
      }
   
        // $product = Product::paginate(3);

        public function shop(Request $request, $id=null )
        {
            $selectedCategories = $request->input('categories', []);
            if ($id) {
                $category = Category::findOrFail($id);
                $product = Product::where('cat_id', $id)->get();
            } else {
                if (empty($selectedCategories)) {
                    $product = Product::all();
                } else {
                    $product = Product::whereIn('cat_id', $selectedCategories)->get();
                }
                $category = null; 
            }
    
            if ($request->ajax()) {
                return response()->json([
                    'message' => $product
                ]);
            }
    
            return view('layouts.shop', compact('product', 'category'));
        }
        

  public function showCartView(Request $request){
    $data = $request->validate([
        'productid' => 'required|array',
        'productid.*' => 'required|integer|exists:products,id',
    ]);

    $productIds = $data['productid'];
    $products = Product::whereIn('id', $productIds )->get();
    return view('layouts.cart', compact('products'));

   }
   public function search(Request $request)
   {
       $query = $request->input('query');
       $products = Product::where('name', 'LIKE', "%$query%")->get();
       return response()->json($products);
   }


    
   
   public function filterProducts(Request $request)
   {
       $query = Product::query();
   
       // Handle category filter
       if ($request->has('category') && $request->input('category') !== '') {
           $categoryId = $request->input('category');
           $query->where('cat_id', $categoryId);
       }
   
       // Handle price filter
       if ($request->has('price') && $request->input('price') !== '') {
           $priceRange = explode('-', $request->input('price'));
           if (count($priceRange) === 2) {
               $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
           }
       }
   
       // If no filters are selected, return all products
       if (!$request->has('category') && !$request->has('price')) {
           return redirect()->route('shop'); // Redirect to shop route to show all products
       }
   
       $products = $query->get();
   
       // Handle AJAX response
       if ($request->ajax()) {
           if ($products->isEmpty()) {
               return response()->json(['html' => '<div class="col-12"><p>No products found.</p></div>']);
           }
   
           return response()->json([
               'html' => view('partials.products', ['products' => $products])->render()
           ]);
       }
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

