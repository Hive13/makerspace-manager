<?php

namespace App\Models;

class Variable extends Model
{
    public $fillable = ['slug','value','permission_id'];

    public function permission() {
        return $this->belongsTo('App\Models\Permission');
    }
}
