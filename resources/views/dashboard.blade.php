@extends('layout.main')

<!-- Apapun yang ada didalam section akan ditampilkan di yield 'content', 
selama ada extends layout.main -->
@section('content')
    <!-- Content Header (Page header) -->
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      @include('partials.particles')
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <lottie-player id="inbox" src="{{ asset('system-solid-9-inbox.json')}}" background="transparent" count="1" speed="1"  style="width: 200px; height: 200px;" loop></lottie-player>
              <div class="inner">
                <h3>{{ $borrow->where('status','Pending')->count() }}</h3>
                <p>Pengajuan Peminjaman</p>
              </div>
              <div class="icon">
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <lottie-player id="list" src="{{ asset('system-solid-17-assignment (1).json')}}" background="transparent" count="1"  speed="1" style="width: 200px; height: 200px;" loop></lottie-player>
              <div class="inner">
                <h3>{{ $borrow->where('status','Approved')->count() }}<sup style="font-size: 20px"></sup></h3>

                <p>Buku Sedang Dipinjam</p>
              </div>
              <div class="icon">
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <lottie-player id="alarm" src="{{ asset('system-solid-7-alarm.json')}}" background="transparent" count="1"  speed="1" style="width: 200px; height: 200px;" loop></lottie-player>
              <div class="inner">
                <h3>{{ $borrow->where('borrow_date',($borrow->return_date))->count() }}</h3>

                <p>Terlambat Pengembalian</p>
              </div>
              <div class="icon">
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <lottie-player id="up" src="{{ asset('system-solid-160-trending-up.json')}}" background="transparent" count="1"  speed="1" style="width: 200px; height: 200px;" loop></lottie-player>
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- /.card -->

            <!-- DIRECT CHAT -->
            <!--/.direct-chat -->

            <!-- TO DO List -->
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- Map card -->
            <!-- /.card -->

            <!-- solid sales graph -->
            <!-- /.card -->

            <!-- Calendar -->
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  @include('script.ldashboard')

@endsection