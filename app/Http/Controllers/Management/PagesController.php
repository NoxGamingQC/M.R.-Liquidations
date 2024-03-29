<?php

namespace App\Http\Controllers\Management;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\PageList;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        $pages = PageList::all();
        if (Auth::check()) {
            if(!Auth::user()->isDev) {
                abort(503);
            }
        } else {
            abort(503);
        }

        return view('management.pages')->with([
            'pages' => $pages
        ]);
    }
}