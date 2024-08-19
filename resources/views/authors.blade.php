@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Daftar Penulis</h1>
          </div>

          <!-- $books dikirim dari web -->
          @foreach ($authors as $author)

          <!-- Cara memanggil dari child class -->
          <a href="/authors/{{ $author->slug }}">{{ $author->name }}</a>
          @endforeach
        </div>
      </div>
    </div>
</div>
@endsection