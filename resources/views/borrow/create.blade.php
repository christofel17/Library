
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
              <h3 class="card-title">Apply Book Lease - {{ $volume->book->title }} ({{ $volume->format }}) id: {{ $volume->id }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/borrow/create/{{ $volume->id }}" method="post">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <body>Start date</body>
                  <input type="date" name="borrow_date" class="form-control @error('borrow_date') is-invalid @enderror" id="borrow_date" value="{{ old('borrow_date') }}">
                  @error('borrow_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <body>End date</body>
                    <input type="date" name="return_date" class="form-control @error('return_date') is-invalid @enderror" id="return_date" value="{{ old('return_date') }}">
                    @error('return_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
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