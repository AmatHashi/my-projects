<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

    }
    public function createForm(){
        return view('users.register');
    }
    public function register(Request $request){
        $data = $request->validate([
            'username' => 'required|string',
            'fullname' => 'required|string',
            'email' => 'required|email', 
            'password' => 'required|min:6', 
        ]);
        $data['password'] = Hash::make($data['password']);

        $user = User::create([
            'username' => $data['username'],
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    
        return response()->json([
            'message' => 'User registered successfully!',
        ]);
    
    }

    public function loginForm(){
        return view('users.login');
    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Login successful!',
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials!',
        ], 401);
    }
}
