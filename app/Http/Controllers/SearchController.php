<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
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
            $itemList[$key] = [
                'id' => $item->id,
                'name' => $item->name,
                'description' => (strlen($item->description) > 80) ? $item->description = substr($item->description, 0, 80) . '...' : $item->description,
                'price' => $item->price,
                'picture' => $item->picture
            ];
        }

        return response()->json($itemList);
    }
}