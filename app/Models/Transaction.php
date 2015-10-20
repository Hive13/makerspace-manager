<?php

namespace App\Models;

use Laracasts\Presenter\PresentableTrait;

class Transaction extends Model
{

    use PresentableTrait;

    protected $presenter = 'App\Presenters\TransactionPresenter';

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
}
