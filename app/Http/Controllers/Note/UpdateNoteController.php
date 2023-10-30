<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use Illuminate\Http\Request;

class UpdateNoteController extends BaseController
{
    public function __invoke(StoreNoteRequest $request, $noteId)
    {
        $data = $request->validated();

        $note = $this->service->getNote($noteId);
        $note->update($data);

        return redirect()->back();
    }
}
