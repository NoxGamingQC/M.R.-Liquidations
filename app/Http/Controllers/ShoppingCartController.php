<?php

namespace App\Http\Controllers;

use Auth;
use App\ShoppingCart;

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

    public function pay() {
        
    }

}