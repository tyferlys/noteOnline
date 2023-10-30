<?php

namespace App\Services\Note;

use App\Models\Note;
use App\Models\User;

class NoteService
{
    public function getUser($login){
        $user = User::where("login", $login)->first();

        return $user;
    }
    public function getNote($noteId){
        $note = Note::find($noteId);

        return $note;
    }
    public function createNote($data){
        Note::create($data);
    }
}
