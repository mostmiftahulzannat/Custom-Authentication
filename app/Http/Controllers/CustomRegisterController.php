<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterStoreRequest;
use App\Models\LoginStore;
use Illuminate\Support\Facades\Auth;

class CustomRegisterController extends Controller
{
    public function registerFormShow(){
        // dd($request->all());

        return view('custom_auth.register');
    }

    public function registerUser(RegisterStoreRequest $request){
        // dd($request->all());
        //create_user
        User::create([
       'name'=>$request->name,
       'email'=>$request->email,
       'phone'=>$request->phone,
       'password'=>Hash::make($request->password),
        ]);

//credintial array
        $credentials =[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
//login attempt
        if(Auth::attempt($credentials)){
           $request->Session()->regenerate();
           return redirect()->intended('home');

        }
        return back()->withErrors([
       'email'=>'Wrong Crediential Found!'
        ])->onlyInput('email');

     }

    public function loginShow(){
    return view('custom_auth.login');
    }

    public function loginUser(LoginStoreRequest $request){
        // dd($request->all());
        //credintial array
        $credentials =[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        //login attempt
        if(Auth::attempt($credentials,$request->filled('remember'))){
        $request->Session()->regenerate();
        return redirect()->intended('home');

        }
        return back()->withErrors([
        'email'=>'Wrong Crediential Found!'
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
          return redirect()->route('login');
    }
}
