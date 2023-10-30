<?php

namespace App\JWTToken;

use App\Models\Token;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function createToken($data){
        $login = $data["login"];

        $payload = [
            "login" => $login,
            "exp" => time() + env("TIME_ALIVE_JWT"),
        ];

        $token = JWT::encode($payload, env("SECRET_KEY_JWT"), "HS256");

        return $token;
    }
    public static function checkToken($token){
        try{
            $check = Token::where("token", $token)->get();

            if (count($check) == 0)
                return "notFound";

            $decodedToken = JWT::decode($token, new Key(env("SECRET_KEY_JWT"), 'HS256'));
            return $decodedToken->login;
        }
        catch (ExpiredException){
            return "notFound";
        }
    }
}
