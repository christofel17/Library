<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Author;
use App\Models\Volume;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Builder;

class BookController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Book::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name',function(Book $book){
                    return empty ($book->author->name) ? $book->author_id : $book->author->name;})
                ->addColumn('author_slug',function(Book $book){
                    return empty ($book->author->slug) ? $book->author_id : $book->author->slug;})
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/edit/books/'. $row->slug .'" class="edit btn btn-success btn-sm">Edit</a> <a href="/delete/books/'. $row->slug .'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('stock',function(Book $book){
                    $total = Volume::all()->where('book_id', $book->id)->count();
                    $count = Volume::whereHas('borrow', function(Builder $query){
                        $query->where('status', 'approved');
                    })->where('book_id', $book->id)->count();
                    return(($total - $count) . '/' . $total);})
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('books');
    }

    public function show(Book $book){
        return view('book', [
            "title" => "Single Book",
            "book" => $book
        ]);
    }
    
    public function authorbooks(Request $request, Book $book){
        if ($request->ajax()) {
            $data = Book::select('*')->where('Author_id', $book->author_id);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name',function(Book $book){
                    return empty ($book->author->name) ? $book->author_id : $book->author->name;})
                ->addColumn('author_slug',function(Book $book){
                    return empty ($book->author->slug) ? $book->author_id : $book->author->slug;})
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('stock',function(Book $book){
                    $count = Volume::all()->where('book_id', $book->id)->count();
                    return($count);})
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('booksauthor', [
            "book" => $book
        ]);
    }

    public function create(Book $book)
    {
        return view('book.create', [
            'title' => 'Register',
            'book' => $book
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author_name' => 'required|max:255',
            'publisher' => 'required|max:255',
            'year' => 'required|max:255'
        ]);
        $thor = Author::where('name', $request->author_name)->first();
        if ($thor === null) {
            Author::create([
                'name' => $request->author_name,
                'slug' => Controller::slugify($request->author_name)
            ]);
        }

        $validatedData['author_id'] = (Author::where('name', $request->author_name)->first()->id);
        $validatedData['slug'] = Controller::slugify($request->title);
        // masukkan data kedalam tabel user di database
        Book::create($validatedData);

        // buat flash message, kirim key 'success' ke halaman redirect
        $x_error = 'flash';  
        $request->session()->$x_error('success', 'Volume Creation Successful');
        return redirect("books");
    }

    public function edit(Book $book)
    {
        return view('book.edit', [
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author_name' => 'required|max:255',
            'publisher' => 'required|max:255',
            'year' => 'required|max:255'
        ]);

        $thor = Author::where('name', $request->author_name)->first();
        if ($thor === null) {
            Author::create([
                'name' => $request->author_name,
                'slug' => Controller::slugify($request->author_name)
            ]);
        }

        $validatedData['author_id'] = (Author::where('name', $request->author_name)->first()->id);
        $validatedData['slug'] = Controller::slugify($request->title);
        unset($validatedData['author_name']);

        Book::where('id', $book->id)
            ->update($validatedData);
        
        return redirect('books')->with('success', 'Buku berhasil diubah!');
    }

    public function destroy(Book $book)
    {
        Book::destroy($book->id);
        return redirect('books')->with('success', 'Book has been deleted!');
    }
    
}
