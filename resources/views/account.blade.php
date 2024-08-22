@extends('layout.main')

@section('content')
@include('partials.particles')
<div class="container">
    <div class="col-sm-3">
        <a type="button" href="/users/edit/{{ auth()->user()->username }}" class="btn btn-primary btn-lg btn-block">Change Account Details
            <lottie-player class="position-relative" id="edit" src="{{ asset('wired-outline-35-edit.json')}}" background="transparent" count="1" speed="1"  style="width: 200px; height: 200px;" loop></lottie-player></a>
        <a type="button" href="/users/delete/{{ auth()->user()->username }}" class="btn btn-warning btn-lg btn-block">Delete Account
            <lottie-player class="position-relative" id="trash" src="{{ asset('wired-outline-185-trash-bin.json')}}" background="transparent" count="1" speed="1"  style="width: 200px; height: 200px;" loop></lottie-player></a>
    </div>
</div>
@include('script.lottie')
@endsection