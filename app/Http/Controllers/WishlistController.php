<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function show(){

        $user = auth()->user();
        $wishlists = $user->wishlists;
        $wishproducts = array();

        foreach($wishlists as $wish){
           $wishproduct = Product::find($wish->product_id); 
           $wishproduct->wish_id = $wish->id;
           $wishproducts[] = $wishproduct; 
        }
        // dd($wishproducts);
        return view('wish.show', compact('wishproducts'));
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'user_id' => ['required'],
            'product_id' => ['required']
        ]);

        
        $wishlist = Wishlist::where('product_id', $request->product_id)
                    ->where('user_id', $request->user_id)
                    ->count();

        if(!$wishlist){
            if(auth()->user()->id == $request->user_id){
                WishList::create($formFields);
                return redirect('/wishlist')->with('success', 'Wishlist added successfully');
            }    
        }else{
            return redirect('/product/'.$request->product_id)->with('alert', 'Product already present in wishlist');
        }
        
        return redirect('/wishlist')->with('alert', 'User id not valid');
    }

    public function destroy(WishList $wishlist){
        $wishlist->delete();
        return redirect('/wishlist')->with('alert','Deleted successfully');
    }
}
