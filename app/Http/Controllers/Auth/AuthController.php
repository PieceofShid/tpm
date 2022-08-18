<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if(!auth()->check()){
            return view('auth.index');
        }

        return $this->level();
    }

    public function login(Request $request)
    {
        $data = $request->only(['username', 'password']);
        if(Auth::attempt($data)){
            return $this->level();
        }

        return redirect()->back()->with('error', 'Username atau password yang anda masukkan salah');
    }

    public function level()
    {
        if(auth()->user()->level_id == 1){
            return redirect()->route('user.index');
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.index');
    }
}
