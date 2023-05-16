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
        $total_amt = 0;

        foreach ($carts as $item) {
            $cartproduct = Product::select('id','name', 'image', 'quantity')->find($item->product_id);
            $cartproduct->cart_id = $item->id;
            $cartproduct->cart_quantity = $item->quantity;
            $cartproduct->amount = $item->amount;
            $total_amt += $cartproduct->amount;
            $cartproducts[] = $cartproduct;
        }
        // dd($cartproducts);
        return view('cart.show', compact('cartproducts', 'total_amt'));
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
        return redirect('/cart')->with('alert', 'Deleted successfully');
    }
    
    public function checkout(Request $request)
    {
        dd($request);
        // return redirect('/wishlist')->with('alert', 'Deleted successfully');
    }

    public function updatequantity(Request $request, Cart $cart)
    {
        $stock_count = $this->getStockCount($cart->product_id);
        $formFields = $request->validate([
            'cart_quantity'=> ['required', 'numeric', 'min:1']
        ]);

        $product_unit_price = Product::where('id', $cart->product_id)
        ->value('price');

        $amount =  $product_unit_price * $request->cart_quantity;
        $formFields['amount'] = $amount;

        if($request->cart_quantity > $stock_count){
            return redirect()->back()->withErrors('Quantity must be less or equal to stock');
        }else{
            $cart->quantity = $formFields['cart_quantity'];
            $cart->amount = $amount;
            $cart->save();
            return redirect('/cart')->with('success', 'Quantity in cart updated successfully');
        }
    }

    public function getStockCount($product_id){
        $stock = Product::select('quantity')->find($product_id);
        return ($stock->quantity);

    }
}
