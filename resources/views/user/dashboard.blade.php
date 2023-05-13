@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="text-center">
    <h1 style="display:inline-flex">Dashboard </h1>
    <span style="float:right;display:inline-flex;" class="p-2">
        {{-- <h5>{{ $user->name }}</h5> --}}

    </span>
</div>

<section>
    <li>{{ $user->name }}</li>
    <li>{{ $user->email }}</li>
    <li>{{ $user->role }}</li>
    <hr>
</section>
@endsection