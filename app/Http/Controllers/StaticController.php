<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class StaticController extends Controller
{
    public function getPage($pageName)
    {
        return view('static.' . $pageName);
    }
}
