@extends('layout')

@section('title', 'Welcome')

@section('content')
<div class="text-center">
    <h1>{{ $product->name }}</h1>
</div>

<section>
    <div class="card my-3" style="max-width: 100%;">
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
                @guest
                @else
                @if (auth()->user()->role == 'user')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-footer">
                    {{-- cart --}}
                    <form style="display: inline-flex" class="mx-2" action="" method="post">
                        @csrf
                        <button class="btn btn-success" type="submit">
                            <i class="bi bi-cart"></i>
                        </button>
                    </form>
                    {{-- wishlist --}}
                    <form style="display: inline-flex" action="/wishlist" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" required>
                        <input type="hidden" name="product_id" value="{{ $product->id }}" required>
                        <button class="btn btn-danger" type="submit">
                            <i class="bi bi-bag-heart-fill"></i>
                        </button>
                    </form>
                </div>
                @endif
                @endguest

            </div>
        </div>
    </div>
</section>
@endsection