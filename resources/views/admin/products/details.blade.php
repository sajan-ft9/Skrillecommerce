@extends('admin.adminlayout')

@section('content')
<section>
    <div style="display: block">
        <h1>
            {{ $product->name }}
            <span style="float:right">
                <a class="btn btn-warning mt-2" href="/admin/edit/{{ $product->id }}">Update</a>
                <form style="display: inline-flex" action="/admin/delete/{{ $product->id }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

                <form style="display: inline-flex" action="/admin/stock/{{ $product->id }}" method="POST">
                    @csrf
                    @method('patch')

                    <input type="number" min="1" class="form-control" required name="quantity" placeholder="Add Stock">

                </form>
            </span>
        </h1>
    </div>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <small class="text-danger">{{ $error }}</small>
    @endforeach
    @endif
    <x-alertmsg />
    <div class="card my-3 mt-5" style="max-width: 100%;display:block">
        <div class="row no-gutters">
            <div class="col-md-6">
                <img src="{{ $product->image }}" class="card-img" alt="...">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title text-info">{{ $product->name }}</h5>
                    <p class="card-title">Category: {{ $product->category }}</p>
                    <p class="card-text"><strong class="text-muted">Rs. {{ $product->price }}</strong></p>
                    <p class="card-text">In Stock: {{ $product->quantity }}</p>

                    <strong class="card-text">Description</strong>
                    <p class="card-text">{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection