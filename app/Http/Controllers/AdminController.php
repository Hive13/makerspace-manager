<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
   public function getIndex() {
       $users = User::All();
       $permissions = Permission::All();
       return view('admin.index')->withUsers($users)->withPermissions($permissions);
   }

    public function postLogin(Request $request) {
        $user = User::find($request->input('user_id'));
        Auth::login($user);
        return redirect('/');
    }

    public function postLearn(Request $request)
    {
        $permission = Permission::find($request->input('permission_id'));
        $permission->learning_user_id = $request->input('user_id');
        $permission->save();
        return redirect('/');

    }
}
