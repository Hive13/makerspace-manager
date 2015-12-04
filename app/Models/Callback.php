<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    public function run() {
        return file_get_contents($this->url);
    }
}
