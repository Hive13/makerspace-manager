<?php
/**
 * Created by PhpStorm.
 * User: tylergetsay
 * Date: 10/14/15
 * Time: 2:05 AM
 */

namespace App\Presenters;


use Laracasts\Presenter\Presenter;

class TransactionTypePresenter extends Presenter
{

    public function typeCost()
    {
        if ($this->cost > 0) {

            return "$" . $this->cost;

        } elseif ($this->cost < 0) {
            return "-$" . substr($this->cost, 1);

        } elseif ($this->cost == 0) {
            return "N/A";
        }
    }
}