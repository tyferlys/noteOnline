<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\OpenAuthRequest;
use App\JWTToken\JWTToken;
use Illuminate\Http\Request;

class OpenAuthController extends BaseController
{
    public function __invoke(OpenAuthRequest $request)
    {
        $data = $request->validated();

        $result = $this->service->open($data);

        if ($result == 0){
            return redirect()->back()->withInput()->withErrors(["login" => "Пользователь не найден"]);
        }
        else if ($result == 1){
            return redirect()->back()->withInput()->withErrors(["password" => "Неверный пароль"]);
        }
        else if ($result == 2){
            $token = JWTToken::createToken($data);
            $cookie = cookie("token", $token, 60*60*60);

            $this->service->addToken($token);

            return redirect()->route("main.index")->withCookie($cookie);
        }

        return "gdfgdfgdf";
    }
}
