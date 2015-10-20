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
        //return "https://pbs.twimg.com/profile_images/651042665690202112/EIChMlk-_400x400.jpg";
        return "https://s3.amazonaws.com/uifaces/faces/twitter/" . $this->picture_id . "/128.jpg";
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

}