@extends('layout')

@section('title', 'Register')

@section('content')
<div class="text-center">
    <h1>Sign up for free</h1>
</div>
<x-alertmsg />
<div class="col-6 mx-auto">
    <form action="/register" method="post" class="form-signin w-100 m-auto">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <input class="form-control mb-1" type="text" name="name" required placeholder="name">
        <input class="form-control mb-1" type="email" name="email" required placeholder="email">
        <input class="form-control mb-1" type="password" name="password" required placeholder="password">
        <input class="form-control mb-1" type="password" name="password_confirmation" required placeholder="confirm password">
        <div class="text-center w-50 mx-auto">
            <button class="form-control mb-1 btn btn-info" type="submit">Register</button>
        </div>
    </form>
    <p>Have Account? <a href="/login">Register</a></p>
</div>

@endsection