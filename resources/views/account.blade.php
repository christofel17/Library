@extends('layout.main')

@section('content')
<a type="button" href="/users/edit/{{ auth()->user()->username }}" class="btn btn-primary btn-lg btn-block">Change Account Details</a>
<a type="button" href="/users/delete/{{ auth()->user()->username }}" class="btn btn-warning btn-lg btn-block">Delete Account</a>
@endsection