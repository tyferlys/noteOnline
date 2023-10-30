<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use http\Cookie;
use Illuminate\Http\Request;

class ExitProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        return redirect()->route("login.index")->withCookie(cookie("token", "none"));
    }
}
