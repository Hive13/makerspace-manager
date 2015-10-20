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

        $user = User::byKey($keyID);

        $perm = Permission::byName($permName);

        event(new PermissionChecked($perm, $user));

        if ($user->has($perm)) {
            return "true";
        }

        return \Illuminate\Http\Response::create('false', 418);

    }
}
