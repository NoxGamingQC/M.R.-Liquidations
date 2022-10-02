<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Items;
use Auth;

class StoreController extends Controller
{
    public function index() {
        $items = Items::orderBy('name')->get();
        $displayedItemCount = Items::getDisplayedItemCount($items);
        if(Auth::check()) {
            $isManager = Auth::user()->isManager;
            $isDev = Auth::user()->isDev;
        } else {
            $isManager = false;
            $isDev = false;
        }
        return view('store')->with([
            'items' => $items,
            'displayedItemCount' => $displayedItemCount,
            'isManager' => $isManager,
            'isDev' => $isDev
        ]);
    }

    public function addItem(Request $request) {
        if(Auth::check()) {
            if(Auth::user()->isManager || Auth::user()->isDev) {
                $item = new Items;
                $item->name = $request->name;
                $item->description = $request->description;
                $item->price = $request->price;
                $item->stock = $request->stock;
                $item->isAvailable = $request->isAvailable;
                $item->isHidden = $request->isHidden;
                $item->picture = $request->picture;

                $item->save();

                return 200;
            }
            abort(403);
        }
        abort(403);
    }

    public function editItem(Request $request) {
        if(Auth::check()) {
            if(Auth::user()->isManager || Auth::user()->isDev) {
                $item = Items::findOrFail($request->id);
                $item->name = $request->name;
                $item->description = $request->description;
                $item->price = $request->price;
                $item->stock = $request->stock;
                $item->isAvailable = $request->isAvailable;
                $item->isHidden = $request->isHidden;
                $item->picture = $request->picture;

                $item->save();

                return 200;
            }
            abort(403);
        }
        abort(403);
    }
}
