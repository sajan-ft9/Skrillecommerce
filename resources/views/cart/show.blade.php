@extends('layout')

@section('title', 'Cart')

@section('content')
<div class="text-center">
    <h1>Cart</h1>
</div>
<x-alertmsg />
<section>
    {{-- <div class="row row-cols-1 row-cols-md-3 g-4"> --}}
        {{-- @foreach ($wishlists as $wishlist) --}}
        @if(count($cartproducts))
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($cartproducts as $index => $item)
              <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>
                  <a class="text-dark" href="/product/{{ $item->id }}">{{ $item->name }}</a>
                </td>
                <td><img src="{{ asset($item->image) }}" height="40px" width="50px" style="border-radius:100%" alt="image"></td>
                <td>{{ $item->quantity }}</td>
                <td>Rs. {{ $item->amount }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>No products here! </strong>
                <a href="/" class="btn btn-danger">Find Products</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
</section>
@endsection