<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;

use Auth;
use App\PageList;
use App\Categories;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index() {
        if(PageList::isInMaintenance('management.categories')) {
            abort(503);
        }
        if(Auth::check()) {
            if(Auth::user()->isDev || Auth::user()->isManager) {
                $categories = Categories::all();

                return view('management.categories')->with([
                    'categories' => $categories,
                ]);
            }
            abort(403);
        }
        abort(403);
    }
}