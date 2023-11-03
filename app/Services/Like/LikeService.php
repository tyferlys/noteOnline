<?php

namespace App\Services\Like;

use App\Models\Like;
use App\Models\Note;
use App\Models\User;
use Exception;

class LikeService
{
    public function like($login, $noteId){
        $user = User::where("login", $login)->first();

        try{
            Like::create([
                "user_id" => $user->id,
                "note_id" => $noteId,
            ]);

            $note = Note::where("id", $noteId)->first();
            return [
                "likes" => $note->likes,
                "status" => 1,
            ];
        }
        catch (Exception){
            Like::where("user_id", $user->id)
                ->where("note_id", $noteId)->delete();

            $note = Note::where("id", $noteId)->first();
            return [
                "likes" => $note->likes,
                "status" => 0,
            ];
        }

    }
}
