<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexProfileController extends BaseController
{
    public function __invoke(Request $request)
    {
        $login = $request->input("login");
        $user = $this->service->getUser($login);

        return view("profile.index", [
            "user" => $user,
        ]);
    }
}
