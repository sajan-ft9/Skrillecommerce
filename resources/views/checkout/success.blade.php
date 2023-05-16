@extends('layout')

@section('title', 'Cart')

@section('content')
<div class="text-center">
  <h1>Cart</h1>
</div>
<x-alertmsg />
<section>
    <div>
        <h2>Success</h2>
        
        <p>Dear,{{ auth()->user()->name }} your payment has been successful.</p>
        <a class="btn btn-info" href="/orders">See Orders</a>
    </div>
</section>
@endsection