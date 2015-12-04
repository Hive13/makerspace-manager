<?php

namespace App\Models;

class Variable extends Model
{
    public $fillable = [
        'slug',
        'value',
        'set_permission_id',
        'get_permission_id'
    ];

    public function get_permission()
    {
        return $this->belongsTo('App\Models\Permission', 'get_permission_id');
    }

    public function set_permission()
    {
        return $this->belongsTo('App\Models\Permission', 'set_permission_id');
    }
}
