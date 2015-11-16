<?php

namespace App\Models;

use Laracasts\Presenter\PresentableTrait;

class Transaction extends Model
{

    use PresentableTrait;

    protected $presenter = 'App\Presenters\TransactionPresenter';

    protected $fillable = ['user_id','transaction_type_id','amount','description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\TransactionType', 'transaction_type_id');
    }

    public function isDeposit()
    {
        if ($this->amount > 0) {
            return true;
        }
        return false;
    }

    public function scopeRecent($query) {
        return $query->orderBy('created_at','dsc');
    }
}
