<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexNoteController extends BaseController
{
    public function __invoke(Request $request)
    {
        $login = $request->input("login");
        $user = $this->service->getUser($login);

        return view("note.index", [
            "user" => $user,
        ]);
    }
}
