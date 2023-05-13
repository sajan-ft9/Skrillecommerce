@extends('admin.adminlayout')

@section('content')
<section>
    <h1>Update {{ $product->name }}</h1>
    <div class="col-6 mx-auto">
        <form action="/admin/edit/{{ $product->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <input class="form-control mb-1" value="{{ $product->name }}" type="text" name="name" required
                placeholder="Name">
            <input class="form-control mb-1" value="{{ $product->category }}" type="text" name="category" required placeholder="Category">

            <textarea class="form-control mb-1" name="description" id="" cols="30" rows="5"
                placeholder="Descriptions">{{$product->description }}</textarea>
            <input class="form-control mb-1" type="number" name="price" value="{{ $product->price }}" required
                placeholder="Price">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Old Photo</label>
                    <img height="200px" width="200px" src="{{ asset($product->image) }}" alt="">
                </div>
                <div class="col-lg-6">
                    <input class="form-control mb-1" id="file-upload" name="image" type="file">
                </div>
            </div>

            <div class="text-center w-50 mx-auto">
                <button class="form-control mb-1 btn btn-info" type="submit">Update</button>
            </div>
        </form>
    </div>
</section>
@endsection