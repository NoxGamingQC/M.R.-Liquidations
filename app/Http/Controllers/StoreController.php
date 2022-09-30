<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Items;

class StoreController extends Controller
{
    public function index() {
        $items = Items::all();
        $displayedItemCount = Items::getDisplayedItemCount($items);
        return view('store')->with([
            'items' => $items,
            'displayedItemCount' => $displayedItemCount,
            
        ]);
    }
}
