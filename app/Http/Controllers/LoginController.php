<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        // folder login, file index
        return view('login.index', [
            'title' => 'Login'
        ]);
    }
    

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        //jika percobaan login benar
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/test');
        }

        // kembali ke halaman sebelumnya dengan key lodinError berisi data login failed
        return back()->with('loginError', 'Login failed!');
    }
    
    public function authenticated(Request $request, $user) {
        $user->last_login = Carbon::now();
        $user->save();
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/test');
    }
}
