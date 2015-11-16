<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {


        $user = Auth::User();
        $user->load('permissions')->load('activities');
        $user->transactions = Transaction::recent()->where('user_id',$user->id)->take(15)->get();


        $user->transactions->load('type');

        return view('welcome')->withUser($user);
    }
}
