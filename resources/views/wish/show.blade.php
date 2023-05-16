@extends('layout')

@section('title', 'Welcome')

@section('content')
<div class="text-center">
    <h1>Wishlist</h1>
</div>
<x-alertmsg />
<section>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        {{-- @foreach ($wishlists as $wishlist) --}}
        @if(count($wishproducts))
        @foreach ($wishproducts as $item)
        <div class="col">
            <div class="card h-100">

                <div class="h-100">
                    <a class="text-decoration-none" href="/product/{{ $item->id }}">

                        <img src="{{ asset($item->image) }}" class="card-img-top" alt="Skyscrapers" />
                    </a>

                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <p class="card-text">
                        Rs.{{ $item->price }}
                    </p>
                </div>

                <div class="card-footer">
                    {{-- cart --}}
                    {{-- <form style="display: inline-flex" class="mx-2" action="" method="post">
                        @csrf
                        <button class="btn btn-success" type="submit">
                            <i class="bi bi-cart"></i>
                        </button>
                    </form> --}}
                    {{-- wishlist delete --}}
                    <form style="display: inline-flex" action="/wishdelete/{{ $item->wish_id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
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