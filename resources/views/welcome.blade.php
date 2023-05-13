@extends('layout')

@section('title', 'Welcome')

@section('content')
<div class="text-center">
    <h1>Welcome</h1>
</div>

<section>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($products as $product)
        <div class="col">
            <a class="text-decoration-none" href="/product/{{ $product->id }}">
                <div class="card h-100">
                    <div class="h-100">
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="Skyscrapers" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            Rs.{{ $product->price }}
                        </p>
                    </div>
                    {{-- <div class="card-footer">
                        <small class="text-muted"></small>
                    </div> --}}
                </div>
            </a>
        </div>
        @endforeach
    </div>
</section>
@endsection