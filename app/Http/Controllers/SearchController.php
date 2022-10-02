<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use Auth;


class SearchController extends Controller
{
    public function store(Request $request) {
        $item = Items::all();
        $search = $request->get('search');

        $items = Items::where('name', 'ilike', '%' . $search . '%')
        ->take(5)
        ->orderBy('name')
        ->get();

        return $items;
    }
}