<?php

namespace App\Services\Main;

use App\Models\Note;

class MainService
{
    public function getLastNotes(){
        $notes = Note::latest()->take(3)->get();

        return $notes;
    }
}
