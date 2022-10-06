<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use App\ItemPictures;
use Auth;


class SearchController extends Controller
{
    public function item(Request $request) {
        $item = Items::all();
        $search = $request->get('search');

        $items = Items::where('name', 'ilike', '%' . $search . '%')
        ->where('isAvailable', true)
        ->take(5)
        ->orderBy('name')
        ->get();

        $itemList = [];

        foreach($items as $key => $item) {
            $picture = ItemPictures::where('itemID', $item->id)->where('isFeatured', true)->first();
            $itemList[$key] = [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'price' => $item->price,
                'picture' => $picture ? $picture->picture : null
            ];
        }

        return response()->json($itemList);
    }
}