<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="{{ asset('js/app.js') }}"></script>
  <title>Dashboard</title>

@include('style.stylesheet')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('lte/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

  @include('partials.navbar')

  <!-- Main Sidebar Container -->
  
    @include('partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
@yield('content')
    </div>
  </div>
</div>
  <!-- /.content-wrapper -->
@include('partials.footer')
</div>

@include('script.script')
</div>
</body>
</html>