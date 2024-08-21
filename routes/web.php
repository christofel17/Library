<?php

use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Borrow;
use App\Models\Volume;
use App\Http\Middleware\isUser;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\VolumeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminAuthorController;

Route::get('/', function(Book $book, User $user, Volume $volume, Borrow $borrow){
    return view('dashboard', [
        'book' => $book,
        'user' => $user,
        'volume' => $volume,
        'borrow' => $borrow
    ]);
});

Route::get('/test', function(Book $book, User $user, Volume $volume, Borrow $borrow){
    return view('dashboard', [
        'book' => $book,
        'user' => $user,
        'volume' => $volume,
        'borrow' => $borrow
    ]);
});

Route::get('books', [BookController::class, 'index'])->name('books.index');
Route::get('books/{book:slug}', [BookController::class, 'show']);
Route::get('books/author/{book:slug}', [BookController::class, 'authorbooks'])->name('booksauthor.index');
Route::get('create/books', [BookController::class, 'create'])->middleware(isAdmin::class);
Route::post('create/books', [BookController::class, 'store'])->middleware(isAdmin::class);
Route::get('edit/books/{book:slug}', [BookController::class, 'edit'])->middleware(isAdmin::class);
Route::post('edit/books/{book:slug}', [BookController::class, 'update'])->middleware(isAdmin::class);
Route::get('delete/books/{book:slug}', [BookController::class, 'destroy'])->middleware(isAdmin::class);


Route::get('/authors', function(){
    return view('authors', [
        'title' => 'All Authors',
        'authors' => Author::all()
    ]);
});

Route::get('/authors/{author:slug}', function(Author $author){
    return view('author', [
        'title' => "Books by $author->name",
        'books' => $author->book->load('author'),
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::resource('/dashboard/author', AdminAuthorController::class)->except('show')->middleware('auth');

Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware(isAdmin::class);
Route::get('/users/create', [RegisterController::class, 'create'])->middleware('auth');
Route::post('/users/create', [RegisterController::class, 'store'])->middleware('auth');
Route::get('/users/delete/{user:username}', [UserController::class, 'destroy'])->middleware('auth');
Route::get('/users/edit/{user:username}', [UserController::class, 'edit'])->middleware('auth');
Route::Post('/users/edit/{user:username}', [UserController::class, 'update'])->middleware('auth');

Route::get('volume/{book:slug}', [VolumeController::class, 'index'])->name('volumes.index');
Route::get('volume/create/{book:slug}', [VolumeController::class, 'create'])->middleware(isAdmin::class);
Route::post('volume/create/{book:slug}', [VolumeController::class, 'store'])->middleware(isAdmin::class);
Route::get('volume/edit/{volume:id}', [VolumeController::class, 'edit'])->middleware(isAdmin::class);
Route::post('volume/edit/{volume:id}', [VolumeController::class, 'update'])->middleware(isAdmin::class);
Route::get('volume/delete/{volume:id}', [VolumeController::class, 'destroy'])->middleware(isAdmin::class);

Route::get('borrow', [BorrowController::class, 'index'])->name('borrows.index')->middleware(isAdmin::class);
Route::get('borrow/users/{user:username}', [BorrowController::class, 'userindex'])->middleware(isAdmin::class)->name('borrows.userindex');
Route::get('borrow/volume/{volume:id}', [BorrowController::class, 'volumeindex'])->name('borrows.volumeindex');
Route::get('borrow/self', [BorrowController::class, 'selfindex'])->middleware('auth')->middleware(isUser::class)->name('borrows.selfindex');
Route::get('borrow/create/{volume:id}', [BorrowController::class, 'create'])->middleware(isUser::class);
Route::post('borrow/create/{volume:id}', [BorrowController::class, 'store'])->middleware(isAdmin::class);
Route::get('borrow/approve/{borrow:id}', [BorrowController::class, 'approve'])->middleware(isAdmin::class);
Route::get('borrow/reject/{borrow:id}', [BorrowController::class, 'reject'])->middleware(isAdmin::class);
Route::get('borrow/cancel/{borrow:id}', [BorrowController::class, 'cancel'])->middleware(isUser::class);
Route::get('borrow/return/{borrow:id}', [BorrowController::class, 'return'])->middleware(isUser::class);


Route::get('/api/books', [VolumeController::class, 'indexapi']);
Route::get('/api/books/{book:id}',[VolumeController::class, 'showapi']);
Route::post('/api/books', [VolumeController::class, 'storeapi']);
Route::post('/api/edit/books/{volume:id}', [VolumeController::class, 'updateapi']);
Route::post('/api/delete/books/{volume:id}', [VolumeController::class, 'destroyapi']);

Route::get('account', function(){
    return view('account');
});

Route::get('/particle', function(){
    return view('partials/particles');
});

Route::get('/practice', function(){
    return view('practice');
});