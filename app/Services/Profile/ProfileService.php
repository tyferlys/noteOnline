<?php

namespace App\Services\Profile;

use App\Models\User;

class ProfileService
{
    public function getUser($login){
        $user = User::where("login", $login)->first();

        return $user;
    }
    public function checkLogin($login){

    }
}
