<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PageList;
use App\ItemPictures;
use App\Items;
use Auth;

class StoreController extends Controller
{
    public function index($language, $page, $sortby = 'alphabetical') {
        if(PageList::isInMaintenance('store')) {
            abort(503);
        }
        $skipCount = (($page * 9) - 9);
        if($sortby == 'alphabetical') {
            $items = Items::getItemsAlphabetical()->skip($skipCount)->take(9)->get();
            $itemCount = Items::getItemsAlphabetical()->count() ? Items::getItemsAlphabetical()->count() : 9;
        }
        $pageCount = (int)ceil(($itemCount / 9));
        
        $currentItemCount = Items::getDisplayedItemCount($items);
        if(Auth::check()) {
            $isManager = Auth::user()->isManager;
            $isDev = Auth::user()->isDev;
        } else {
            $isManager = false;
            $isDev = false;
        }

        $hiddenItem = Items::hidden()->get();
        $displayedItem = Items::displayed()->get();
        $availableItem = Items::available()->get();
        $notAvailableItem = Items::notAvailable()->get();

        return view('store')->with([
            'items' => $items,
            'currentItemCount' => $currentItemCount,
            'isManager' => $isManager,
            'isDev' => $isDev,
            'pageCount' => $pageCount,
            'currentPage' => $page,
            'displayedItemCount' => count($displayedItem),
            'hiddenItemCount' => count($hiddenItem),
            'availableItemCount' => count($displayedItem),
            'notAvailableItemCount' => count($hiddenItem),
        ]);
    }

    public function addItem(Request $request) {
        if(PageList::isInMaintenance('store')) {
            abort(503);
        }
        if(Auth::check()) {
            if(Auth::user()->isManager || Auth::user()->isDev) {
                $item = new Items;
                $item->name = $request->name;
                $item->description = $request->description;
                $item->price = $request->price;
                $item->stock = $request->stock;
                $item->isAvailable = $request->isAvailable;
                $item->isHidden = $request->isHidden;
                $item->save();
                if($request->picture) {
                    $picture = new ItemPictures;
                    $picture->picture = $request->picture;
                    $picture->itemID = $item->id;
                    $picture->isFeatured = true;
                    $picture->save();
                }


                return 200;
            }
            abort(403);
        }
        abort(403);
    }

    public function editItem(Request $request) {
        if(PageList::isInMaintenance('store')) {
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

                $item->save();

                return 200;
            }
            abort(403);
        }
        abort(403);
    }

    public function showItem($language, $id) {
        if(PageList::isInMaintenance('store')) {
            abort(503);
        }
       $item = Items::findOrFail($id);
       $canSeeHiddenItems = false;
       if(Auth::check()) {
            if(Auth::user()->isManager || Auth::user()->isDev) {
                $canSeeHiddenItems = true;
            }
       }
       if(!$item->isHidden || $canSeeHiddenItems) {
            $pictures = ItemPictures::getAllPictures($item->id);

            return view('item')->with([
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
}
