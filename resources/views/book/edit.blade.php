
@extends('layout.main')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Book</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/edit/books/{{ $book->slug }}" method="post">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title" value="{{ old('title', $book->title) }}">
                  @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="author_name" class="form-control @error('author_name') is-invalid @enderror" id="author_name" placeholder="Author Name" value="{{ old('author_name', $book->author->name) }}">
                    @error('author_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror" id="publisher" placeholder="Publisher" value="{{ old('publisher', $book->publisher) }}">
                    @error('publisher')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input type="text" name="year" class="form-control @error('year') is-invalid @enderror" id="year" placeholder="Year" value="{{ old('year', $book->year) }}">
                    @error('year')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  
  @endsection