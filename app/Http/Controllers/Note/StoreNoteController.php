<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use Illuminate\Http\Request;

class StoreNoteController extends BaseController
{
    public function __invoke(StoreNoteRequest $request, $userId)
    {
        $data = $request->validated();
        $data["user_id"] = $userId;

        $this->service->createNote($data);

        return redirect()->route("profile.index");
    }
}
