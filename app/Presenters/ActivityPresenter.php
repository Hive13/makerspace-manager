<?php
/**
 * Created by PhpStorm.
 * User: tylergetsay
 * Date: 10/14/15
 * Time: 2:05 AM
 */

namespace App\Presenters;


use Laracasts\Presenter\Presenter;

class ActivityPresenter extends Presenter
{

    public function name()
    {
        return $this->activity->name;
    }

    public function displayTime()
    {
        return $this->created_at->format('M j, Y');
    }

}