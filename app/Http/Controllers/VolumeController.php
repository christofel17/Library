<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreVolumeRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateVolumeRequest;

class VolumeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Book $book)
    {
        if ($request->ajax()) {
            $data = Volume::select('*')->where('book_id',$book->id);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    if(Volume::whereHas('borrow', function(Builder $query){
                        $query->where('status', 'approved');})->where('id', $row->id)->exists()){
                        return "Borrowed";
                    }
                    else{
                        return "Available";
                    }
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/borrow/volume/' . $row->id . '" class="history btn btn-primary btn-sm">History</a>';
                    if((Auth::check()) != null){
                        if(auth()->user()->is_admin === 0){
                            $actionBtn .= 
                            ' <a href="/borrow/create/' . $row->id . '" class="btn btn-info btn-sm">Apply</a>';
                        }
                        else if(auth()->user()->is_admin === 1){
                            $actionBtn .= 
                            ' <a href="/volume/edit/' . $row->id . '" class="edit btn btn-success btn-sm">Edit</a>'.
                            ' <a href="/volume/delete/' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                        }
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('volume', [
            'book' => $book
        ]);
    }

    public function showapi(Book $book){
        $books = Volume::where('book_id',$book->id)->get();
        return response([
            'success' => true,
            'message' => 'Daftar volume dari buku: ' . $book->title,
            'data' => $books
        ], 200);
    }

    public function indexapi(){
        $books = Volume::all();
        return response([
            'success' => true,
            'message' => 'Daftar Semua Volume',
            'data' => $books
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        return view('volume.create', [
            'title' => 'Register',
            'book' => $book
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'format' => 'required|max:255',
            'edition' => 'required|max:255',
            'state' => 'required|max:255'
        ]);
        $validatedData['book_id'] = $book->id;

        // masukkan data kedalam tabel user di database
        Volume::create($validatedData);

        // buat flash message, kirim key 'success' ke halaman redirect
        $x_error = 'flash';  
        $request->session()->$x_error('success', 'Volume Creation Successful');
        return redirect("volume/" . $book->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Volume $volume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Volume $volume)
    {
        return view('volume.edit', [
            'volume' => $volume
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Volume $volume)
    {
        $validatedData = $request->validate([
            'format' => 'required|max:255',
            'edition' => 'required|max:255',
            'state' => 'required|max:255'
        ]);

        Volume::where('id', $volume->id)
            ->update($validatedData);
        
        return redirect('volume/'. $volume->book->slug)->with('success', 'Volume berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Volume $volume)
    {
        Volume::destroy($volume->id);
        return redirect('volume/'. $volume->book->slug)->with('success', 'Volume has been deleted!');
    }

    public function storeapi(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'book_id'    => 'required',
            'format'     => 'required',
            'edition'   => 'required',
            'state'    => 'required'
        ],
            [
                'book_id.required' => 'Masukkan Id Buku !',
                'format.required' => 'Masukkan Format Buku !',
                'edition.required' => 'Masukkan Edisi Buku !',
                'state.required' => 'Masukkan Kondisi Buku !',
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $volume = Volume::create([
                'book_id'     => $request->input('book_id'),
                'format'     => $request->input('format'),
                'edition'     => $request->input('edition'),
                'state'     => $request->input('state'),
            ]);
            if ($volume) {
                return response()->json([
                    'success' => true,
                    'message' => 'Buku Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Buku Gagal Disimpan!',
                ], 401);
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateapi(Request $request, Volume $volume)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'book_id'    => 'required',
            'format'     => 'required',
            'edition'   => 'required',
            'state'    => 'required'
        ],
            [
                'book_id.required' => 'Masukkan Id Buku !',
                'format.required' => 'Masukkan Format Buku !',
                'edition.required' => 'Masukkan Edisi Buku !',
                'state.required' => 'Masukkan Kondisi Buku !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $vol = Volume::whereId($volume->id)->update([
                'book_id'     => $request->input('book_id'),
                'format'     => $request->input('format'),
                'edition'     => $request->input('edition'),
                'state'     => $request->input('state'),
            ]);

            if ($vol) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Diupdate!',
                ], 401);
            }

        }

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroyapi(Volume $volume)
    {
        $vol = Volume::findOrFail($volume->id);
        $vol->delete();

        if ($vol) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Dihapus!',
            ], 400);
        }

    }
}
