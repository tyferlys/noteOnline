<?php

namespace App\Services\Auth;

use App\Models\Token;
use App\Models\User;

class AuthService
{
    public function open($data){
        $user = User::where("login", $data["login"])->get();

        if (count($user) == 0)
            return 0;
        else {
            $password = $user[0]->password;

            if ($password == $data["password"])
                return 2;
            else
                return 1;
        }
    }
    public function create($data){
        User::create([
            "login" => $data["login"],
            "password" => $data["password"],
        ]);
    }
    public function addToken($token){
        Token::create([
            "token" => $token,
        ]);
    }
}
