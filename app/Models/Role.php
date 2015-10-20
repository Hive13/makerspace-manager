<?php

namespace App\Models;


class Role extends Model
{
    public static function byName($roleName)
    {
        return Role::where('name', $roleName);
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
