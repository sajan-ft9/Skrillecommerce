@extends('layout')

@section('title', 'Login')

@section('content')
<div class="text-center">
    <h1>Login</h1>
</div>
<x-alertmsg />
<div class="col-6 mx-auto">
    <form action="/login" method="post">
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

        <input class="form-control mb-1" type="email" name="email" required placeholder="email">
        <input class="form-control mb-1" type="password" name="password" required placeholder="password">
        <div class="text-center w-50 mx-auto">
            <button class="form-control mb-1 btn btn-info" type="submit">Login</button>
        </div>
    </form>
    <p>Not Registered? <a href="/register">Create account</a></p>
</div>

@endsection