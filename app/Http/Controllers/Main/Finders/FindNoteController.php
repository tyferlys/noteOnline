<?php

namespace App\Http\Controllers\Main\Finders;

use Illuminate\Http\Request;

class FindNoteController extends BaseController
{
    public function __invoke(Request $request){

        $page = $request->input("page");

        if ($page == null || $page <= 1)
            $page = 1;

        $data = $request->validate([
            "text" => "string",
        ]);

        $dataNotes = $this->service->findNotes([
            "text" => $data["text"],
            "page" => $page - 1,
        ]);

        return view("note.viewAllNote", [
            "notes" => $dataNotes["notes"],
            "text" => $data["text"],
            "page" => $page,
            "max" => $dataNotes["max"],
        ]);
    }
}
