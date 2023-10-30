<?php

namespace App\Services\Finders;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class FindersService
{
    public function findUsers($data){
        $users = DB::table("users");

        if ($data["login"] != "none")
            $users = $users->where("login",  $data["login"]);
        if ($data["name"] != "none")
            $users = $users->where("name",  $data["name"]);
        if ($data["surname"] != "none")
            $users = $users->where("surname",  $data["surname"]);

        return $users->offset(4 * $data["page"])->orderByDesc("id")->limit(4)->get();
    }
}
