<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function welcome(Request $request)
    {
        if ($request->search) {
            $products = Product::where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('category', 'LIKE', '%' . $request->search . '%')
                ->get();
            return view('welcome', compact('products'));
        } else {
            $products = Product::all();
            return view('welcome', compact('products'));
        }
    }

    public function all()
    {
        $products = Product::all();
        return view('admin.products.products', compact('products'));
    }

    public function lowstocks()
    {
        $low_stocks = Product::where('quantity', '<', 5)->get();
        return view('admin.products.lowstocks', compact('low_stocks'));
    }



    public function createForm()
    {
        return view('admin.products.create');
    }

    public function details(Product $product)
    {
        return view('admin/products/details', compact('product'));
    }
    public function prod_details(Product $product)
    {
        return view('details', compact('product'));
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'category' => ['required', 'min:1', 'max:255'],
            'description' => ['required', 'min:3', 'max:1024'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:4096']
        ]);

        if (!isset($request->image)) {
            $formFields['image'] = "/storage/images/default.png";
        } else {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName, 'public');
            $formFields['image'] = '/storage/images/' . $imageName;
        }

        Product::create($formFields);
        return redirect('/admin/products')->with('success', 'Product added successfully!');
    }

    public function editForm(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'category' => ['required', 'min:1', 'max:255'],
            'description' => ['required', 'min:3', 'max:1024'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:4096']
        ]);

        if (!isset($request->image)) {
            $product->update($formFields);
        } else {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName, 'public');
            $formFields['image'] = '/storage/images/' . $imageName;
            $product->update($formFields);
        }

        return redirect('admin/product/' . $product->id)->with('success', 'Updated successfully!');
    }
    public function addstock(Request $request, Product $product)
    {
        $formFields = $request->validate([
            'quantity' => ['required', 'numeric', 'min:1'],
        ]);

        $old_stock = $product->quantity;
        $updated_stock = $old_stock + $request->quantity;
        $formFields['quantity'] = $updated_stock;

        $product->update($formFields);

        return redirect('admin/product/' . $product->id)->with('success', 'Stock added successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('admin/products')->with('alert', 'Deleted successfully!');
    }
}
