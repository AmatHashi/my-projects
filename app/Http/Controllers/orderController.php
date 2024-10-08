<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; 

class orderController extends Controller
{
    

    public function index(){
        $order = OrderDetail::with('order')->get();
        return view('orders.index', compact('order'));
    }

    public function get(){
        return view('layouts.checkout');
    }
    public function checkout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);        
        
        DB::beginTransaction();
        try {
            $cartItems = Cart::with('product')->get();
            $totalAmount = 0;
            foreach ($cartItems as $item) {
                if (!$item->product) {
                    throw new \Exception('Product not found.');
                }
                $totalAmount += $item->qty * $item->product->price;
            }

            $user = Auth::user(); 

            $order = Order::create([
                'user_id' => $user->id,  
                'date' => now()->toDateString(),
                'total' => $totalAmount,
                'payment_method' => $request->input('payment_method'),
            ]);

            foreach ($cartItems as $item) {
                OrderDetail::create([  
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'price' => $item->product->price,
                    'total' => $item->qty * $item->product->price,
                ]);
            }

            Cart::truncate();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Go to payment to get your product.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error during checkout: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);
            return back()->withErrors(['error' => 'An error occurred. Please try again.']);
        }
    }
}
