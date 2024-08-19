<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Session;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    public function create(){
        return view('user.create', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request){
        // validasi data dari form
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],

            // dns supaya domainnya benar
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        // masukkan data kedalam tabel user di database
        User::create($validatedData);

        // buat flash message, kirim key 'success' ke halaman redirect
        $x_error = 'flash';  
        $request->session()->$x_error('success', 'Registration successful! Please login');

        return redirect('/test');
    }
}
