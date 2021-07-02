<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::user()){
            return redirect(route('dashboard.index'));
        }

        return view('back.auth.index');
    }

    public function post(Request $request)
    {
        // dd($request->all());
        $credentials = [
            'username' => $request->email,
            'password' => $request->password,
        ];
    
        if (Auth::attempt($credentials)) {
            // return 'oke';
            return redirect(route('dashboard.index'));
        }
        return redirect()->back()->with('fail','Username atau password salah !');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
