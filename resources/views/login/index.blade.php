
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Log in</title>
@include('partials.particles')

@include('style.stylesheet')

</head>
<body class="hold-transition login-page">


<!-- Alert success setelah berhasil register. jika didalam session ada key yang namanya success, tampilkan message yang beserta --> 
    @if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
@endif

<!-- Jika login gagal -->
@if(session()->has('loginError'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('loginError') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
@endif

<div class="login-box">
<div class="login-logo">
<a href="../../index2.html"><b>Admin</b>LTE</a>
</div>


<div class="card">
<div class="card-body login-card-body">
<p class="login-box-msg">Sign in to start your session</p>


<form action="/login" method="post">
@csrf
<div class="input-group mb-3">
<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" autofocus value="{{ old('email') }}">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-envelope"></span>
</div>
</div>
@error('email')
<div class="invalid-feedback">
    <small>"{{ $message }}"</small>
</div>
@enderror
</div>
<div class="input-group mb-3">
<input type="password" name="password" class="form-control" placeholder="Password" id="password">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-8">
<div class="icheck-primary">
<input type="checkbox" id="remember">
<label for="remember">
Remember Me
</label>
</div>
</div>

<div class="col-4">
<button type="submit" class="btn btn-primary btn-block">Sign In</button>
</div>

</div>
</form>

<p class="mb-1">
<a href="forgot-password.html">I forgot my password</a>
</p>
<p class="mb-0">
<a href="/register" class="text-center">Register a new membership</a>
</p>
</div>

</div>
</div>

@include('script.script')

</body>
</html>
