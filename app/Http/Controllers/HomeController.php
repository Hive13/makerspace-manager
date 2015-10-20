<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {

        $user = Auth::User()->with('permissions')->
        with(['transactions' => function ($query) {
            $query->orderBy('created_at', 'asec');
        }])->get()->first();
        $user->transactions->load('type');

        return view('welcome')->withUser($user);
    }
}
