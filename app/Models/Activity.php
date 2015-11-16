<?php

namespace App\Models;

use Laracasts\Presenter\PresentableTrait;

class Activity extends Model
{

    use PresentableTrait;

    protected $presenter = "App\Presenters\ActivityPresenter";

    public function activity()
    {
        return $this->morphTo();
    }
}
