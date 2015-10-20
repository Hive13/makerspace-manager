<?php
/**
 * Created by PhpStorm.
 * User: tylergetsay
 * Date: 10/13/15
 * Time: 5:36 PM
 */

namespace App\Presenters;


use Laracasts\Presenter\Presenter;

class TransactionPresenter extends Presenter
{

    public function purchaseDate()
    {
        return $this->created_at->format('M j, Y');
    }

    public function dollarAmount()
    {
        if ($this->amount > 0) {

            return "$" . $this->amount;

        } elseif ($this->amount < 0) {
            return "-$" . substr($this->amount, 1);

        }
    }

}