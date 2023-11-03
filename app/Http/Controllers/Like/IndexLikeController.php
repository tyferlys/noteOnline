<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class IndexLikeController extends BaseController
{
    public function __invoke(Request $request, $noteId)
    {
        $login = $request->input("login");

        $likes = $this->service->like($login, $noteId);

        return response()->json([
            "countLike" => count($likes["likes"]),
            "statusLike" => $likes["status"],
            "status" => "true",
        ]);
    }
}
