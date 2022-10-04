<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\ItemPictures;
use App\Items;
use Auth;

class ItemsController extends Controller
{
    public function index() {
        if(Auth::check()) {
            if(Auth::user()->isDev || Auth::user()->isAdmin) {
                $items = Items::orderBy('id', 'desc')->get();

                return view('management.items')->with([
                    'items' => $items,
                ]);
                abort(404);
            }
            abort(403);
        }
        abort(403);
    }
}