<?php

namespace App\Models;

use Laracasts\Presenter\PresentableTrait;

class TransactionType extends Model
{

    use PresentableTrait;

    protected $fillable = ['name', 'description', 'permission_id', 'cost', 'purchasable'];

    protected $presenter = 'App\Presenters\TransactionTypePresenter';

    public static function byName($typeName)
    {
        return TransactionType::where('name', $typeName)->firstOrFail();
    }

    public function permission()
    {
        return $this->belongsTo('App\Models\Permission');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
