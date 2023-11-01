<?php

namespace App\Http\Controllers\Main\Finders;

use Illuminate\Http\Request;

class FindNoteController extends BaseController
{
    public function __invoke(Request $request){
        $data = $request->validate([
            "text" => "string",
        ]);
        $notes = $this->service->findNotes($data["text"]);

        dd($notes);
    }
}
