@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Buku dari {{ $title }}</h1>
          </div>

          <!-- $books dikirim dari web -->
          @foreach ($books as $book)
          <a href="/books/{{ $book->slug }}">{{ $book->title }}</a>

          <!-- Cara memanggil dari child class -->
          <a href="/authors/{{ $book->author->slug }}">{{ $book->author->name }}
          <h5>{{ $book->publisher }}</h5>
          <h5>{{ $book->year }}</h5>
          @endforeach
        </div>
      </div>
    </div>
</div>
@endsection