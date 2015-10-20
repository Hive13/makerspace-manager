<?php

namespace App\Models;

class TransactionType extends Model
{

    public static function byName($typeName)
    {
        return TransactionType::where('name', $typeName)->firstOrFail();
    }

    public function permission()
    {
        return $this->belongsTo('App\Models\Permission');
    }
}
