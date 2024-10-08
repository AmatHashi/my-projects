<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public  function index(){
        return view('layouts.signup');
    }

    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email', 
            'password' => 'required|min:6' 
        ]);
    
        $data['password'] = bcrypt($data['password']);
    
        $user = User::create($data);
    
        
        return response()->json(['message' => 'User registered successfully.'], 201);
    }
    public function showLoginForm()
    {
        return view('layouts.login'); 
    }

    public function login(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|max:8|min:4',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // return redirect()->intended('admin'); 
        return redirect()->route('hero');
    } 

     return back()->withErrors([
        'email' => 'INVALID_CREDENTIALS.',
    ]);

    }

    public function logout()
{
    Auth::logout(); 
    return redirect()->route('signin'); 
}


}
