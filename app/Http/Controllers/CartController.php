<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $carts = $user->carts;
        $cartproducts = array();
        $total_amt = 0;
        foreach ($carts as $item) {
            $cartproduct = Product::select('id', 'name', 'image', 'quantity')->find($item->product_id);
            $cartproduct->cart_id = $item->id;
            $cartproduct->cart_quantity = $item->quantity;
            $cartproduct->amount = $item->amount;
            $total_amt += $cartproduct->amount;
            $cartproducts[] = $cartproduct;
        }


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

        if ($request->quantity > $db_quantity) {
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

        if ($already_exists == 0) {
            Cart::create($formFields);
            return redirect('/cart')->with('success', 'Product added to cart');
        } else {
            $cart_item = Cart::where('user_id', auth()->user()->id)
                ->where('product_id', $request->product_id)
                ->first();

            if ($cart_item) {
                $cart_item->update($formFields);
                return redirect('/cart')->with('success', 'Added to cart');
            } else {
                return redirect('/cart')->with('alert', 'Cart item not found');
            }
        }
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect('/cart')->with('alert', 'Deleted successfully');
    }


    public function updatequantity(Request $request, Cart $cart)
    {
        $stock_count = $this->getStockCount($cart->product_id);
        $formFields = $request->validate([
            'cart_quantity' => ['required', 'numeric', 'min:1']
        ]);

        $product_unit_price = Product::where('id', $cart->product_id)
            ->value('price');

        $amount =  $product_unit_price * $request->cart_quantity;
        $formFields['amount'] = $amount;

        if ($request->cart_quantity > $stock_count) {
            return redirect()->back()->withErrors('Quantity must be less or equal to stock');
        } else {
            $cart->quantity = $formFields['cart_quantity'];
            $cart->amount = $amount;
            $cart->save();
            return redirect('/cart')->with('success', 'Quantity in cart updated successfully');
        }
    }

    public function getStockCount($product_id)
    {
        $stock = Product::select('quantity')->find($product_id);
        return ($stock->quantity);
    }


    public function checkout(Request $request)
    {
        $formFields = $request->validate([
            'phone' => ['required'],
            'address' => ['required'],
        ]);

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $lineItems  = [];


        $cartproducts = $this->getCartProducts();


        foreach ($cartproducts as $product) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => ($product->price),
                ],
                'quantity' => $product->cart_quantity,
            ];
        }


        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        foreach ($cartproducts as $product) {
            $order = new Order();

            $order->status = 'unpaid';
            $order->total_price = $product->amount;
            $order->user_id = auth()->user()->id;
            $order->user_name = auth()->user()->name;
            $order->product_name = $product->name;
            $order->product_id = $product->id;
            $order->quantity = $product->cart_quantity;
            $order->session_id = $checkout_session->id;
            $order->phone = $request->phone;
            $order->image = $product->image;
            $order->address = $request->address;
            $order->save();
        }
        return redirect($checkout_session->url);
    }

    public function success(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $sessionId = $request->get('session_id');

        try {
            $session = $stripe->checkout->sessions->retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException();
            }

            $orders = Order::where('session_id', $session->id)
            ->where('status', 'unpaid')
            ->get();
            if(count($orders) == 0){
                // throw new NotFoundHttpException();
                return redirect('/');
            }
            foreach($orders as $order){
                $order->status = 'paid';
                $order->save();
            }

            $cartproducts = $this->getCartProducts();
            
            foreach($cartproducts as $item){
                $cart = Cart::where('id', $item->cart_id)->delete();
                $product = Product::where('id', $item->id)->first();
                if($product){
                    $newQuantity = $item->quantity - $item->cart_quantity;
                    $product->update([
                        'quantity' => $newQuantity
                    ]);
                }
            }
            
            return view('checkout.success');
        } catch (\Throwable $th) {
            throw new NotFoundHttpException();
        }
    }

    public function cancel()
    {
        return view('checkout.fail');
    }

    public function webhook(){

    }


    public function getCartProducts()
    {
        $user = auth()->user();
        $carts = $user->carts;
        $cartproducts = array();
        foreach ($carts as $item) {
            $cartproduct = Product::select('id', 'name', 'price', 'image', 'quantity')->find($item->product_id);
            $cartproduct->cart_id = $item->id;
            $cartproduct->cart_quantity = $item->quantity;
            $cartproduct->amount = $item->amount;
            
            $cartproducts[] = $cartproduct;
        }

        return $cartproducts;
    }

    
    public function orders(){

        $orders = Order::where('user_id', auth()->user()->id)->get();
        $total = 0;
        foreach($orders as $order){
            $total += $order->total_price;
        }
        return view('orders.show', compact('orders', 'total'));
    }

    
}
