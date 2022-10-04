<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\ItemPictures;
use App\Items;
use Auth;

class ItemController extends Controller
{
    public function index($language, $id) {
        if(Auth::check()) {
            if(Auth::user()->isDev || Auth::user()->isAdmin) {
                $item = Items::findOrFail($id);
                $canSeeHiddenItems = false;
                if(Auth::check()) {
                    if(Auth::user()->isDev || Auth::user()->isAdmin) {
                        $canSeeHiddenItems = true;
                    }
                }
                if(!$item->isHidden || $canSeeHiddenItems) {
                    $pictures = ItemPictures::getAllPictures($item->id);

                    return view('management.item')->with([
                        'id' => $item->id,
                        'name' => $item->name,
                        'description' => $item->description,
                        'price' => $item->price,
                        'stock' => $item->stock,
                        'isAvailable' => $item->isAvailable,
                        'pictures' => $pictures
                    ]);
                }
                abort(404);
            }
            abort(403);
        }
        abort(403);
    }
}