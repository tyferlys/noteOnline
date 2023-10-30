<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(Request $request)
    {
        $login = $request->input("login");

        $notes = $this->service->getLastNotes();

        return view("main.index", [
            "login" => $login,
            "notes" => $notes,
        ]);
    }
}
