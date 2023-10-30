<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthRequest;
use Illuminate\Http\Request;

class StoreAuthController extends BaseController
{
    public function __invoke(StoreAuthRequest $request)
    {
        $data = $request->validated();
        $this->service->create($data);

        return redirect()->route("login.index");
    }
}
