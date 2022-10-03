<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Items;
use Auth;

class StoreController extends Controller
{
    public function index($language, $page) {
        $itemCount = Items::all()->count() ? Items::all()->count() : 9;
        $pageCount = ($itemCount / 9);
        $skipCount = (($page * 9) - 9);
        $items = Items::orderBy('name')->skip($skipCount)->take(9)->get();
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
            'isDev' => $isDev,
            'pageCount' => $pageCount
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

    public function showItem($language, $id) {
       $item = Items::findOrFail($id);
        return view('item')->with([
            'name' => $item->name,
            'description' => $item->description,
            'price' => $item->price,
            'stock' => $item->stock,
            'isAvailable' => $item->isAvailable,
            'picture' => $item->picture
        ]);
    }
}
