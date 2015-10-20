<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;

class TransactionController extends Controller
{
    public function makeTransaction($keyID, $typeName, $customAmount = "0")
    {

        $user = User::byKey($keyID);

        $transType = TransactionType::byName($typeName);

        if (is_null($transType->cost)) {
            if ($customAmount > 0) {
                $cost = $customAmount;
            } else {
                $cost = 0;
            }
        } else {
            $cost = $transType->cost;
        }

        if (is_null($transType->permission) || $user->has($transType->permission)) {
            if ($transType->cost <= $user->balance) {
                if ($cost > 0) {
                    $trans = new Transaction();
                    $trans->transaction_type_id = $transType->id;
                    $trans->user_id = $user->id;
                    $trans->amount = '-' . $cost;
                    if ($trans->save()) {
                        return "true";
                    }
                }
            }
        }
        return \Illuminate\Http\Response::create('false', 418);

    }
}
