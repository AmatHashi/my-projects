<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
{
    
        $user = User::all();
        return view('users.index', compact('user'));
    
}
    public function createForm(){
        return view('users.register');
    }
    public function register(Request $request){
        $data = $request->validate([
            'username' => 'required|string',
            'email' => 'required|email', 
            'addres' => 'required', 
            'password' => 'required|min:6', 
        ]);
        $data['password'] = Hash::make($data['password']);

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'addres' => $data['addres'],
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
                'user'=>$credentials
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials!',
        ], 401);
    }

    public function edit($id)
    {
        
     $user = User::findOrFail($id);
        
    }
    public function update(Request $request,$id){
    $data=$request->validate([
        'fullname'=>'required',
        'username'=>'required',
        'email'=>'required',
    ]);
    $user=User::findOrFail($id);
    $user->update($data);
    return response()->json([
        'message'=>'updated user'
    ],201);

  }
}
