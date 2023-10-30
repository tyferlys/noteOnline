<?php

namespace App\Http\Controllers\Note;

use Illuminate\Http\Request;

class DeleteNoteController extends BaseController
{
    public function __invoke(Request $request, $noteId){
        $note = $this->service->getNote($noteId);

        if($request->input("login") == $note->user->login)
            $note->delete();

        return redirect()->route("profile.index");
    }
}
