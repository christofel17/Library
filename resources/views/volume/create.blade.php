
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
              <h3 class="card-title">Create Volume</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/volume/create/{{ $book->slug }}" method="post">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <input type="text" name="format" class="form-control @error('format') is-invalid @enderror" id="format" placeholder="Format" value="{{ old('format') }}">
                  @error('format')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="edition" class="form-control @error('edition') is-invalid @enderror" id="edition" placeholder="Edition" value="{{ old('edition') }}">
                    @error('edition')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" id="state" placeholder="Condition" value="{{ old('state') }}">
                    @error('state')
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