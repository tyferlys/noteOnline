<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewProfileController extends BaseController
{
    public function __invoke(Request $request, $login)
    {
        $loginCurrent = $request->input("login");

        if ($loginCurrent == $login)
            return redirect()->route("profile.index");

        $user = $this->service->getUser($login);

        return view("profile.view", [
            "user" => $user,
        ]);
    }
}
