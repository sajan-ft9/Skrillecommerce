@extends('layout')

@section('title', 'Cart')

@section('content')
<div class="text-center">
  <h1>Orders</h1>
</div>
<x-alertmsg />
<section>
  @if(count($orders))

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Order Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $index => $item)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>
          {{-- <input type="hidden" name="product_name[]" value="{{ $item->name }}"> --}}
          <a class="text-dark" href="/product/{{ $item->product_id }}">{{ $item->product_name }}</a>
        </td>
        <td><img src="{{ asset($item->image) }}" height="40px" width="50px" style="border-radius:100%" alt="image">
        </td>
        <td>
          {{ $item->quantity }}
        </td>
        <td>
          Rs. {{ number_format($item->total_price) }}
        </td>
        <td>
          {{ $item->created_at }}
        </td>

      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th colspan="4">Total</th>
        <th colspan="2">Rs.{{ number_format($total) }}</th>
      </tr>
    </tfoot>
  </table>


  @else
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>No products here! </strong>
    <a href="/" class="btn btn-danger">Find Products</a>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
</section>
@endsection