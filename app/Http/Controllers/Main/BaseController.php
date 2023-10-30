<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Services\Main\MainService;

class BaseController extends Controller
{
    protected MainService $service;

    public function __construct(MainService $service)
    {
        $this->service = $service;
    }
}
