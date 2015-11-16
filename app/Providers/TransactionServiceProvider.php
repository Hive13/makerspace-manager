<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class TransactionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Transaction::saving(function ($trans) {
            $user = User::find($trans->user_id);
            if ($user->balance < -$trans->amount) {
                return false;
            } else {
                $trans->running = $user->balance + $trans->amount;
            }
        });

        Transaction::saved(function ($trans) {
            $user = User::find($trans->user_id);
            $user->balance = $user->balance + $trans->amount;
            $user->save();
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
