<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {

        $user = auth()->user();
        $carts = $user->carts;
        $cartproducts = array();

        foreach ($carts as $item) {
            $cartproduct = Product::select('id','name', 'image')->find($item->product_id);
            $cartproduct->cart_id = $item->id;
            $cartproduct->quantity = $item->quantity;
            $cartproduct->amount = $item->amount;
            $cartproducts[] = $cartproduct;
        }
        // dd($cartproducts);
        return view('cart.show', compact('cartproducts'));
    }

    public function store(Request $request)
    {


        $formFields = $request->validate([
            'product_id' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric', 'min:1'],
        ]);

        $db_quantity = Product::where('id', $request->product_id)
        ->value('quantity');

        if($request->quantity > $db_quantity){
            return redirect()->back()->withErrors('Given Quantity exceeds stock');
        }

        $product_unit_price = Product::where('id', $request->product_id)
        ->value('price');

        $amount =  $product_unit_price * $request->quantity;
        $formFields['amount'] = $amount;
        $formFields['user_id'] = auth()->user()->id;
        
        $already_exists = Cart::where('product_id', $request->product_id)
        ->where('user_id', auth()->user()->id)
        ->count();

        if($already_exists == 0){
            Cart::create($formFields);
            return redirect('/cart')->with('success', 'Product added to cart');
        }else{
            $cart_item = Cart::where('user_id', auth()->user()->id)
            ->where('product_id', $request->product_id)
            ->first();
            
            if($cart_item){
                $cart_item->update($formFields);
                return redirect('/cart')->with('success', 'Added to cart');
            }else{
                return redirect('/cart')->with('alert', 'Cart item not found');
            }
        }


    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect('/wishlist')->with('alert', 'Deleted successfully');
    }
}
