<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke(Request $request) {
        if( Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first(['username', 'email', 'first_name', 'last_name', 'profile_picture']);
            return view('welcome', [
                'user' => $user,
            ]);
        } else {
            return view('welcome');

        }
    }
}
