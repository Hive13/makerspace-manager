<?php
/**
 * Created by PhpStorm.
 * User: tylergetsay
 * Date: 10/13/15
 * Time: 3:55 PM
 */

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    public function displayPicture()
    {

        if (is_null($this->picture_id)) {
            return "http://gravatar.com/avatar/" . md5(strtolower(trim("$this->email"))) . "?d=identicon&s=400";
        }

        return url('img/pp/' . $this->picture_id);
    }

    public function lastSeen()
    {
        if (is_null($this->last_seen)) {
            return "Never";
        }
        return $this->last_seen->diffForHumans();
    }

    public function memberSince()
    {
        return $this->created_at->format('M j, Y.');
    }

    public function bankBalance() {
        return "$".$this->balance;
    }

}