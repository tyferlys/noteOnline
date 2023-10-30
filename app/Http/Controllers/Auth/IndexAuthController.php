<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Faker\Provider\Base;
use Illuminate\Http\Request;

class IndexAuthController extends BaseController
{
    public function __invoke(Request $request)
    {
        return view("auth.index");
    }
}
