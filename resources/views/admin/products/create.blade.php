@extends('admin.adminlayout')

@section('content')
<section>
    <h1>New Product</h1>
    <div class="col-6 mx-auto">
        <form action="/admin/newproduct" method="post" enctype="multipart/form-data">
            @csrf
    
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    
            <input class="form-control mb-1" value="{{ old('name') }}" type="text" name="name" required placeholder="Name">
            <input class="form-control mb-1" value="{{ old('category') }}" type="text" name="category" required placeholder="Category">
            <textarea class="form-control mb-1" name="description" id="" cols="30" rows="5" placeholder="Descriptions">{{ old('description') }}</textarea>
            <input class="form-control mb-1" type="number" value="{{ old('price') }}" name="price" required placeholder="Price">
            <input class="form-control mb-1" type="number" value="{{ old('quantity') }}" name="quantity" required placeholder="Quantity">
            <input class="form-control mb-1" id="file-upload" name="image" type="file">

            <div class="text-center w-50 mx-auto">
                <button class="form-control mb-1 btn btn-info" type="submit">Add Product</button>
            </div>
        </form>
    </div>
</section>
@endsection