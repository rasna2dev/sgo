<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

abstract class AbstractController extends Controller
{
    protected $currentRouteName;


    public function __construct()
    {
        $this->currentRouteName = Route::currentRouteName();
    }

    public function getNomeRota()
    {
        return Route::currentRouteName();
    }
}
