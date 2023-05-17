@extends('admin.adminlayout')

@section('content')
<section>
  <h1>Low Stocks</h1>
  <x-alertmsg />
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">User</th>
        <th scope="col">Product</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Address</th>
        <th scope="col">Phone</th>
        <th scope="col">Delivered</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $index => $item)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $item->user_name }}</td>


        <td><img src="{{ asset($item->image) }}" height="40px" width="50px" style="border-radius:100%" alt="image"></td>
        <td>{{ $item->quantity }}</td>
        <td>Rs. {{ $item->total_price}}</td>
        <td>{{ $item->address}}</td>
        <td>{{ $item->phone}}</td>
        <td>
          @if ($item->deliver_status == 0)
          <form action="/admin/deliver/{{ $item->id }}" method="post">
            @csrf
            @method('patch')
            <button class="btn btn-danger" type="submit">Not Delivered</button>
          </form>
          @else
          <small class="btn btn-success">Delivered</small>
          @endif

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</section>
@endsection