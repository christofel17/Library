<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 
                    '<a href="/users/edit/' . $row->username . '" class="edit btn btn-success btn-sm">Edit</a> 
                    <a href="/users/delete/' . $row->username . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('users');
    }

    public function destroy(Request $request, User $user){
        User::destroy($user->id);
        return redirect('/users')->with('success', 'User has been deleted!');
    }

    public function edit(User $user){
        return view('user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user){
        $rules = [
            'name' => 'required|max:255',
            // dns supaya domainnya benar
            'password' => 'required|min:5|max:255'
        ];

        if($request->username != $user->username) {
            $rules['username'] = 'required|unique:users';
        }

        if($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        $validatedData = $request->validate($rules);
        User::where('id', $user->id)
            ->update($validatedData);
        
        return redirect('/test')->with('success', 'User berhasil diedit!');
    }
    
}