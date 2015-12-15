<?php

namespace App\Http\Controllers\API\v1;

use App\Events\PermissionChecked;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Permission;
use App\Models\User;

class PermissionController extends Controller
{
    public function checkPermission($keyID, $permName)
    {

        $perm = Permission::byName($permName);

        if (!is_null($perm->learning_user_id)) {
            $user = User::find($perm->learning_user_id);
            $user->key_id = $keyID;
            $user->save();
            $perm->learning_user_id = NULL;
            $perm->save();
        }

        if (!$user = User::byKey($keyID)) {
            return "false";
        }


        event(new PermissionChecked($perm, $user));

        if ($user->has($perm)) {
            return "true";
        }

        return \Illuminate\Http\Response::create('false', 418);

    }
}
