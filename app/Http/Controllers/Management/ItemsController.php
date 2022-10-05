<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\ItemPictures;
use App\Items;
use Auth;
use App\PageList;

class ItemsController extends Controller
{
    public function index() {
        if(PageList::isInMaintenance('management.items')) {
            abort(503);
        }
        if(Auth::check()) {
            if(Auth::user()->isDev || Auth::user()->isManager) {
                $items = Items::orderBy('id', 'desc')->get();

                return view('management.items')->with([
                    'items' => $items,
                ]);
            }
            abort(403);
        }
        abort(403);
    }
}