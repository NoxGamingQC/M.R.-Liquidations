<?php

namespace App\Http\Controllers;

use Auth;
use App\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index() {
        
        if(Auth::check()) {
            $cart = ShoppingCart::where('user_id', Auth::user()->id)->getItems()->get();
            $total = 0.00;
            $tps = 0.05;
            $tvq = 0.09975;
            foreach($cart as $key => $item) {
                $total += floatval(str_replace(",", ".", $item->price));
            }
            $grandTotal = number_format($total + ($total * $tps) + ($total * $tvq), 2);
            return view('profile.shopping_cart')->with([
                'shoppingCart' => $cart,
                'total' => $total            
            ]);
        } else {
            abort(403);
        }
    }

    public function add(Request $request) {
        if(Auth::check()) {
            $cartItem = new ShoppingCart;
            $cartItem->item_id = $request->id;
            //$cartItem->quantity = $request->quantity;
            $cartItem->user_id = Auth::user()->id;
            $cartItem->save();
        }
        return redirect()->back()->with('success', trans('shopping_cart.added_cart_success'));
    }

    public function remove(Request $request) {
        if(Auth::check()) {
            $cartItem = ShoppingCart::findOrFail($request->id);
            $cartItem->delete();
        }
        return redirect()->back();
    }

    public function pay() {
        
    }

}