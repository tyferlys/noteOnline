<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;

class UpdateProfileController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateProfileRequest $request)
    {
        $data = $request->validated();

        $user = $this->service->getUser($data["login"]);
        $user->update($data);

        return redirect()->back();
    }
}
