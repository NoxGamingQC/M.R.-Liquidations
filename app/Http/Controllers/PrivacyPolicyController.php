<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageList;

class PrivacyPolicyController extends Controller
{
    public function index() {
        if(PageList::isInMaintenance('privacy_policy')) {
            abort(503);
        }
        return view('privacy_policy');
    }
}
