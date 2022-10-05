<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\ItemPictures;
use App\Items;
use Auth;
use App\PageList;

class CategoriesController extends Controller
{
    public function index() {
        abort(403);
    }
}