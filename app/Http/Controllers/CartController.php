<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{

    public function index(){
        $carts = Cart::with('product')->get();
    
        // Calculate subtotal
        $subtotal = 0;
        foreach ($carts as $row) {
            $subtotal += $row->qty * $row->product->price;
        }
    
        // Set a fixed shipping cost
        $shipping = 5.00;
    
        // Pass subtotal and shipping to the view
        return view('layouts.cart', compact('carts', 'subtotal', 'shipping'));
        // $carts = Cart::with('product')->get();
        // return view ('layouts.cart',compact('carts'));
    }

    public function addToCart(Request $request)
    {
        $data = $request->validate([
            'qty' => 'required',
            'product_id' => 'required|exists:products,id',
        ]);
    
        try {
            $cart = Cart::where('product_id', $data['product_id'])->first();
    
            if ($cart) {
                $cart->qty += $data['qty'];
                $cart->save();
            } else {
                Cart::create([
                    'product_id' => $data['product_id'],
                    'qty' => $data['qty'],
                ]);
            }
            $cartCount = Cart::sum('qty');

    
            return response()->json(['success' => true, 'cartCount' => $cartCount, 'status' => 200]);
        } catch (\Exception $e) {
            \Log::error('Error adding to cart: ' . $e->getMessage());
    
            return response()->json(['success' => false, 'message' => 'An error occurred'], 500);
        }
    }
    public function delete($id) {
         $delete = Cart::where('id', $id)->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Cart item deleted successfully.',
        ]);
    }
    public function checkout(){

        $cartItems = Cart::with('product')->get();
        
        return view('layouts.checkout',compact('cartItems'));
    }

    
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'qty' => 'required|integer|min:1'
        ]);
    
        // Find the cart item using the provided cart_id
        $cart = Cart::find($request->cart_id);
    
        if ($cart) {
            // Update the quantity
            $cart->qty = $request->qty;
            $cart->save();
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }
    
        // Retrieve updated cart items with product details
        $cartItems = Cart::with('product')->get();
    
        // Calculate the new subtotal
        $subtotal = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->qty * $item->product->price);
        }, 0);
    
        // Prepare the response with updated cart items and totals
        $response = [
            'success' => true,
            'cartItems' => $cartItems,
            'subtotal' => $subtotal // Return as a number, not a formatted string
        ];
    
        return response()->json($response);
    }
    
    
}    