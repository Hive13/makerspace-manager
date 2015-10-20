<?php

namespace App\Models;

use App\Models\Traits\EasySelect;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Laracasts\Presenter\PresentableTrait;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;


class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    BillableContract
{
    use Authenticatable, Authorizable, CanResetPassword, PresentableTrait, Billable, EasySelect;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $presenter = 'App\Presenters\UserPresenter';

    protected $displayName = 'name';

    public static function byKey($KeyID)
    {
        return User::Where('key_id', $KeyID)->firstOrFail();
    }

    /**
     * Return all transactions by User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function addFriend(User $user)
    {
        $this->friends()->attach($user->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function friends()
    {
        return $this->belongsToMany('App\Models\User', 'user_friend', 'user_id', 'friend_id');
    }

    public function removeFriend(User $user)
    {
        $this->friends()->detach($user->id);
    }

    public function getDates()
    {
        return array_merge(parent::getDates(), array('last_seen'));
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission')->withTimestamps()->withPivot(['is_master', 'created_at']);
    }

    public function has(Permission $permission)
    {
        if ($this->permissions->contains($permission->id) || $this->is('admin') || $this->is('master')) {
            return true;
        }
        return false;
    }

    public function is($roleName)
    {
        $role = Role::byName($roleName)->first();
        if (!is_null($role)) {
            if ($this->roles->contains($role->id)) {
                return true;
            }
        }
        return false;
    }

    public function activities()
    {
        return $this->hasMany('App\Models\Activity');
    }


}
