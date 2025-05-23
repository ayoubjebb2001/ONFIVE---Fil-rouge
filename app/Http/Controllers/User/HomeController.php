<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Psy\debug;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('welcome');
    }
}
