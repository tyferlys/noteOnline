<?php

namespace App\Http\Controllers\Main\Finders;

use App\Http\Controllers\Controller;
use App\Services\Finders\FindersService;

class BaseController extends Controller
{
    protected FindersService $service;

    public function __construct(FindersService $service)
    {
        $this->service = $service;
    }

}
