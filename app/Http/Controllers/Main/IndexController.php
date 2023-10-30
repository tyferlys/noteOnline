<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $login = $request->input("login");

        return view("main.index", [
            "login" => $login,
        ]);
    }
}
