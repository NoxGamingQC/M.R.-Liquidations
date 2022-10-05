<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\PageList;
use App\ItemPictures;
use App\Items;
use Auth;

class ItemController extends Controller
{
    public function index($language, $id) {
        if(PageList::isInMaintenance('management.items')) {
            abort(503);
        }
        if(Auth::check()) {
            if(Auth::user()->isDev || Auth::user()->isManager) {
                $item = Items::findOrFail($id);
                $canSeeHiddenItems = false;
                if(Auth::check()) {
                    if(Auth::user()->isDev || Auth::user()->isManager) {
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
                        'isHidden' => $item->isHidden,
                        'pictures' => $pictures
                    ]);
                }
                abort(404);
            }
            abort(403);
        }
        abort(403);
    }

    public function edit(Request $request) {
        if(PageList::isInMaintenance('management.items')) {
            abort(503);
        }
        if(Auth::check()) {
            if(Auth::user()->isManager || Auth::user()->isDev) {
                $item = Items::findOrFail($request->id);
                $item->name = $request->name;
                $item->description = $request->description;
                $item->price = $request->price;
                $item->stock = $request->stock;
                $item->isAvailable = $request->isAvailable;
                $item->isHidden = $request->isHidden;
                if($request->picture) {
                    $itemPicture = new ItemPictures;
                    $itemPicture->picture = $request->picture;
                    $itemPicture->itemID = $request->id;
                    $allItemPictures = ItemPictures::where('itemID', $request->id);
                    if(!count($allItemPictures->where('isFeatured', true)->get())) {
                        $itemPicture->isFeatured = true;
                    }
                    $itemPicture->save();
                }

                if($request->featured) {
                    if(count(ItemPictures::where('itemID', $request->id)->where('isFeatured', true)->get()) >= 1) {
                        $currentlyFeaturedItem = ItemPictures::where('itemID', $request->id)->where('isFeatured', true)->first();
                        $currentlyFeaturedItem->isFeatured = false;
                        $currentlyFeaturedItem->save();
                    }

                    $featuredItem = ItemPictures::findOrFail($request->featured);
                    $featuredItem->isFeatured = true;
                    $featuredItem->save();
                }
                $item->save();

                return 200;
            }
            abort(403);
        }
        abort(403);
    }

    public function deletePicture(Request $request) {
        if(PageList::isInMaintenance('management.items')) {
            abort(503);
        }
        if(Auth::check()) {
            if(Auth::user()->isManager || Auth::user()->isDev) {
                $picture = ItemPictures::findOrFail($request->id);
                $picture->delete();
                return 200;
            }
            abort(403);
        }
        abort(403);
    }
}