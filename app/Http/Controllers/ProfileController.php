<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;


class ProfileController extends Controller
{
    public function index() {
        if(Auth::check()) {
            $user = User::findOrFail(Auth::user()->id);
            return view('profile.edit', [
                'id' => $user->id,
                'username' => $user->name,
                'email' => $user->email,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'phoneNumber' => $user->phoneNumber,
                'address' => $user->address,
                'postalCode' => $user->postalCode,
                'city' => $user->city,
                'state' => $user->state,
                'country' => $user->country,
                'appartement' => $user->appartement,
                'depositComment' => $user->depositComment,
            ]);
        } else {
            abort('403');
        }
    }

    public function edit() {

    }
}
