@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="text-center">
    <h1>Dashboard</h1>
</div>

<section>
    <li>{{ $user->name }}</li>
    <li>{{ $user->email }}</li>
    <li>{{ $user->role }}</li>
    <hr>
</section>
@endsection