<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\User;
use App\Models\Variable;

class VariableController extends Controller
{


    public function get($varName, $keyId = 0)
    {
        $variable = Variable::firstOrCreate(['slug' => $varName]);
        if ($variable->get_permission_id > 0) {
            if ($keyId > 0) {
                $user = User::byKey($keyId);
                if (!$user->has($variable->get_permission)) {
                    return response("false", 500);
                } else {
                    return $variable->value;
                }
            }
        } else {
            return $variable->value;
        }
        return response("false", 500);
    }

    public function set($varName, $varValue, $keyId = 0)
    {
        $variable = Variable::firstOrCreate(['slug' => $varName]);

        if ($variable->set_permission_id > 0) {
            if ($keyId > 0) {
                $user = User::byKey($keyId);
                if (!$user->has($variable->set_permission)) {
                    return response("false", 500);
                } else {
                    $variable->value = $varValue;
                    $variable->save();
                    return response("true", 200);
                }
            }
            return response("false", 500);
        } else {
            $variable->value = $varValue;
            $variable->save();
            return response("true", 200);
        }
    }


}
