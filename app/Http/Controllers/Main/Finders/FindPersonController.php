<?php

namespace App\Http\Controllers\Main\Finders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FindPersonController extends BaseController
{
    public function __invoke(Request $request, $login, $name, $surname, $page)
    {
        $users = $this->service->findUsers([
            "login" => $login,
            "name" => $name,
            "surname" => $surname,
            "page" => $page,
        ]);

        return response()->json([
            "data" => $users,
        ]);
    }
}
