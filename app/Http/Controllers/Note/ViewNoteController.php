<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class ViewNoteController extends BaseController
{
    public function __invoke(Request $request, $noteId)
    {
        $login = $request->input("login");

        $user = $this->service->getUser($login);
        $note = $this->service->getNote($noteId);

        $checkLike = $this->service->checkLike($user->id, $noteId);

        if ($note->user->login === $login){
            return view("note.view", [
                "user" => $user,
                "note" => $note,
                "status" => 1,
            ]);
        }
        else {
            return view("note.view", [
                "user" => $user,
                "note" => $note,
                "status" => 0,
                "checkLike" => $checkLike,
            ]);
        }

    }
}
