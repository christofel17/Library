@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Direktori Buku</h1>

          </div>
          <h5>{{ $book->title }}</h5>

            <!-- Blade escape character untuk memperbolehkan sintax html di field author -->
            <a href="/authors/{{ $book->author->slug }}">{{ $book->author->name }}
            <h5>{{ $book->year }}</h5>
        </div>
      </div>
    </div>
    <a href="/books">Back to books</a>
</div>
@endsection