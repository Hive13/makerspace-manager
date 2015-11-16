<?php

namespace App\Models;

class Permission extends Model
{


    protected $fillable = ['name', 'description'];

    public static function byName($permName)
    {
        return Permission::where('name', $permName)->firstOrFail();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withPivot(['is_master', 'created_at']);
    }
}
