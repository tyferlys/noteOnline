<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Note\BaseController;
use App\Models\User;
use Illuminate\Http\Request;

class ViewAllNoteController extends BaseController
{
    public function __invoke(Request $request, $userId){
        $user = User::where("id", $userId)->first();

        return view("note.viewAll", [
            "user" => $user,
        ]);
    }
}
