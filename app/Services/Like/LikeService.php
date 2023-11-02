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
            return $note->likes;
        }
        catch (Exception){
            $note = Note::where("id", $noteId)->first();
            return $note->likes;
        }

    }
}
