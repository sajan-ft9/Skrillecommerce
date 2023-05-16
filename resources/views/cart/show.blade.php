@extends('layout')

@section('title', 'Cart')

@section('content')
<div class="text-center">
  <h1>Cart</h1>
</div>
<x-alertmsg />
<section>
  @if(count($cartproducts))

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
        <th scope="col">In stock</th>
        <th scope="col">Price</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cartproducts as $index => $item)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>
          {{-- <input type="hidden" name="product_name[]" value="{{ $item->name }}"> --}}
          <a class="text-dark" href="/product/{{ $item->id }}">{{ $item->name }}</a>
        </td>
        <td><img src="{{ asset($item->image) }}" height="40px" width="50px" style="border-radius:100%" alt="image">
        </td>

        <td>
          <form action="/cartquantityupdate/{{ $item->cart_id }}" method="POST">
            @csrf
            @method('patch')
            <input type="number" name="cart_quantity" min="1" class="px-4 border border-0 border-bottom"
              value="{{ $item->cart_quantity }}">
          </form>
        </td>
        <td>
          {{ $item->quantity }}
        </td>
        <td>
          Rs. {{ number_format($item->amount) }}
        </td>
        <td>
          <a class="btn btn-danger" href="{{ url('deletecart', $item->cart_id) }}"><i class="bi bi-trash"></i></a>
        </td>

      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th colspan="5">Total</th>
        <th colspan="2">Rs. {{ number_format($total_amt) }}</th>
      </tr>
    </tfoot>
  </table>
  {{-- <input type="tel" required name="phone" placeholder="Phone" />
  <input type="text" required name="Address" placeholder="Address" /> --}}
  <form action="/checkout" style="display: inline-flex" method="post">
    @csrf
    <button class="btn btn-info" type="submit">Checkout</button>
  </form>
  <a href="/" style="display: inline-flex" class="btn btn-secondary">Find more</a>


  @else
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>No products here! </strong>
    <a href="/" class="btn btn-danger">Find Products</a>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
</section>
@endsection