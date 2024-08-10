<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{

    public function index(){
        $carts = Cart::with('product')->get();
        return view ('layouts.cart',compact('carts'));
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
    
    
    
    
    
}
