<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use App\Services\Like\LikeService;

class BaseController extends Controller
{
    protected LikeService $service;

    public function __construct(LikeService $service)
    {
        $this->service = $service;
    }

}
