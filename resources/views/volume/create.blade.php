
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
            <form action="/volume/create/{{ $book->slug }}" method="post" id="volumeform">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <select name="format" class="form-select" id="format">
                    <option value="">Format</option>
                    <option value="Hardcover">Hardcover</option>
                    <option value="Paperback">Paperback</option>
                    <option value="Softcover">Softcover</option>
                    <option value="E-book">E-book</option>
                    <option value="Audiobook">Audiobook</option>
                  </select>
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
                    <select name="state" class="form-select" id="state">
                      <option value="">Condition</option>
                      <option value="New">New</option>
                      <option value="Very Good">Very Good</option>
                      <option value="Good">Good</option>
                      <option value="Fair">Fair</option>
                      <option value="Poor">Poor</option>
                      <option value="Digital">Digital</option>
                    </select>
                  </div>
                
                    <!--
                    <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" id="state" placeholder="Condition" value="{{ old('state') }}">
                    <div class="invalid-feedback">
                    </div>
                    -->
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