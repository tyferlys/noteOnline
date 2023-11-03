<?php

namespace App\Services\Finders;

use App\Models\Note;
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

    public function findNotes($data){
        $text = $data['text'];
        $page = $data['page'];
        $notes = Note::latest()
            ->where("title", '~', "$text")
            ->orWhere("text", '~', "$text")
            ->offset(6 * $page)
            ->limit(6)
            ->get();

        $notesCount = Note::count();
        $maxCount = intdiv($notesCount, 6) + 1;

        return [
            "notes" => $notes,
            "max" => $maxCount,
        ];
    }
}
