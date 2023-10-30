<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Models\User;
use Illuminate\Http\Request;

class StoreNoteController extends BaseController
{
    public function __invoke(StoreNoteRequest $request, $userId)
    {
        $data = $request->validated();
        $data["user_id"] = $userId;
        $user = User::where("id", $userId)->first();

        if($request->input("login") == $user->login)
            $this->service->createNote($data);

        return redirect()->route("profile.index");
    }
}
