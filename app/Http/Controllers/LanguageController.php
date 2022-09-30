<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LanguageController extends Controller
{
    public function index($language)
    {
        if($language == 'fr-ca' || $language == 'en-ca') {
            app()->setLocale($language);
        } else {
            abort(403);
        }
        if(!session()->has('url.intended'))
        {
            $redirectTo = str_replace([url('/'), '/en-ca', '/fr-ca'], '', url()->previous());
        } else {
            $redirectTo = '/';
        }

        return redirect(app()->getLocale() . $redirectTo);
    }
}
