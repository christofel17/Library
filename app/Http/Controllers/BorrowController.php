<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Borrow;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreBorrowRequest;
use App\Http\Requests\UpdateBorrowRequest;
use Illuminate\Support\Facades\Session;


class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Volume $volume)
    {

        if ($request->ajax()) {
            $data = Borrow::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name',function(Borrow $borrow){
                    return empty ($borrow->user->name) ? $borrow->user_id : $borrow->user->name;})
                ->addColumn('title',function(Borrow $borrow){
                    return empty ($borrow->volume->book->title) ? $borrow->volume_id : $borrow->volume->book->title;})
                ->addColumn('username',function(Borrow $borrow){
                    return empty ($borrow->user->username) ? $borrow->user_id : $borrow->user->username;})
                ->addColumn('action', function($row){
                    $actionBtn = 
                    '<a href="/borrow/approve/' . $row->id . '" class="edit btn btn-success btn-sm">Approve</a> 
                    <a href="/borrow/reject/' . $row->id . '" class="delete btn btn-danger btn-sm">Reject</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('borrows', [
            'volume' => $volume
        ]);
    }

    public function userindex(Request $request, User $user, Volume $volume)
    {
        if ($request->ajax()) {
            $data = Borrow::select('*')->where('user_id',$user->id);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name',function(Borrow $borrow){
                    return empty ($borrow->user->name) ? $borrow->user_id : $borrow->user->name;})
                ->addColumn('title',function(Borrow $borrow){
                    return empty ($borrow->volume->book->title) ? $borrow->volume_id : $borrow->volume->book->title;})
                ->addColumn('username',function(Borrow $borrow){
                    return empty ($borrow->user->username) ? $borrow->user_id : $borrow->user->username;})
                ->addColumn('action', function($row){
                    $actionBtn = 
                    '<a href="/borrow/approve/' . $row->id . '" class="edit btn btn-success btn-sm">Approve</a> 
                    <a href="/borrow/reject/' . $row->id . '" class="delete btn btn-danger btn-sm">Reject</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('borrowsuser', [
            'user' => $user,
            'volume' => $volume
        ]);
    }

    public function selfindex(Request $request, User $user, Volume $volume)
    {
        if ($request->ajax()) {
            $data = Borrow::select('*')->where('user_id', auth()->user()->id);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name',function(Borrow $borrow){
                    return empty ($borrow->user->name) ? $borrow->user_id : $borrow->user->name;})
                ->addColumn('title',function(Borrow $borrow){
                    return empty ($borrow->volume->book->title) ? $borrow->volume_id : $borrow->volume->book->title;})
                ->addColumn('username',function(Borrow $borrow){
                    return empty ($borrow->user->username) ? $borrow->user_id : $borrow->user->username;})
                ->addColumn('action', function($row){
                    $actionBtn = 
                    '<a href="/borrow/cancel/' . $row->id . '" class="history btn btn-warning btn-sm">Cancel</a>
                    <a href="/borrow/return/' . $row->id . '" class="history btn btn-primary btn-sm">Return</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('borrowsme', [
            'user' => $user,
            'volume' => $volume,
        ]);
    }

    public function volumeindex(Request $request, Volume $volume)
    {
        if ($request->ajax()) {
            $data = Borrow::select('*')->where('volume_id', $volume->id);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name',function(Borrow $borrow){
                    return empty ($borrow->user->name) ? $borrow->user_id : $borrow->user->name;})
                ->addColumn('title',function(Borrow $borrow){
                    return empty ($borrow->volume->book->title) ? $borrow->volume_id : $borrow->volume->book->title;})
                ->addColumn('username',function(Borrow $borrow){
                    return empty ($borrow->user->username) ? $borrow->user_id : $borrow->user->username;})
                ->addColumn('action', function($row){
                    if(auth()->user()->is_admin === 0){
                        $actionBtn = 
                        '<a href="/borrow/cancel/'.$row->id.'" class="history btn btn-warning btn-sm">Cancel</a>
                        <a href="/borrow/return/'.$row->id.'" class="history btn btn-primary btn-sm">Return</a>';
                    }
                    else if (auth()->user()->is_admin === 1){
                        $actionBtn =
                        '<a href="/borrow/approve/' . $row->id . '" class="edit btn btn-success btn-sm">Approve</a> 
                        <a href="/borrow/reject/' . $row->id . '" class="delete btn btn-danger btn-sm">Reject</a>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('borrowsvolume', [
            'volume' => $volume,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Volume $volume)
    {
        return view('borrow.create', [
            'title' => 'Register',
            'volume' => $volume
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Volume $volume)
    {
        $validatedData = $request->validate([
            'borrow_date' => 'required|after:yesterday',
            'return_date' => 'required|after:yesterday|after_or_equal:borrow_date',
        ]);
        $validatedData['volume_id'] = $volume->id;
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['status'] = "Pending";

        // masukkan data kedalam tabel user di database
        Borrow::create($validatedData);

        // buat flash message, kirim key 'success' ke halaman redirect
        $x_error = 'flash';  
        $request->session()->$x_error('success', 'Volume Creation Successful');
        return redirect("/borrow/self");
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrow $borrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function approve(Borrow $borrow)
    {
        if(($borrow->status) === "Pending"){
            $new['status'] = "Approved";
            Borrow::where('id', $borrow->id)
                ->update($new);
        }
        return redirect('borrow');
    }

    /**
     * Update the specified resource in storage.
     */
    public function reject(Borrow $borrow)
    {
        if(($borrow->status) === "Pending"){
            $new['status'] = "Rejected";
            Borrow::where('id', $borrow->id)
                ->update($new);
        }
        return redirect('borrow');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function return(Borrow $borrow)
    {
        if(($borrow->status) === "Approved"){
            $new['status'] = "Finished";
            Borrow::where('id', $borrow->id)
                ->update($new);
        }
        return redirect('/borrow/self');
    }

    public function cancel(Borrow $borrow)
    {
        if(($borrow->status) === "Pending" || ($borrow->status) === "Approved"){
            $new['status'] = "Cancelled";
            Borrow::where('id', $borrow->id)
                ->update($new);
        }
        return redirect('/borrow/self');
    }
}
