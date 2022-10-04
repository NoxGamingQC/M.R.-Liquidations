<?php

namespace App\Http\Controllers;

use App\PageList;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index() {
        if(PageList::isInMaintenance('contact_us')) {
            abort(503);
        }
        return view('contact_us');
    }
}
