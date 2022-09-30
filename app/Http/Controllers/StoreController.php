<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Items;
use Auth;

class StoreController extends Controller
{
    public function index() {
        $items = Items::all();
        $displayedItemCount = Items::getDisplayedItemCount($items);
        return view('store')->with([
            'items' => $items,
            'displayedItemCount' => $displayedItemCount,
            'isManager' => Auth::user()->isManager,
            'isDev' => Auth::user()->isDev
        ]);
    }
}
