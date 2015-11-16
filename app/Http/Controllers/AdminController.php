<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
   public function getIndex() {
       $users = User::All();
       return view('admin.index')->withUsers($users);
   }

    public function postLogin(Request $request) {
        $user = User::find($request->input('user_id'));
        Auth::login($user);
        return redirect('/');
    }
}
