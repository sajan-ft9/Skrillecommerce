@extends('admin.adminlayout')

@section('content')
<section>
    <h1>Low Stocks</h1>
    <x-alertmsg />
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
    @foreach ($low_stocks as $index => $item)
          <tr>
            <th scope="row">{{ $index + 1 }}</th>
            <td>
              <a class="text-dark" href="/admin/product/{{ $item->id }}">{{ $item->name }}</a>
              </td>
            <td><img src="{{ asset($item->image) }}" height="40px" width="50px" style="border-radius:100%" alt="image"></td>
            <td>{{ $item->quantity  }}</td>
            <td>Rs. {{ $item->price }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
</section>
@endsection