<?php

namespace App\Models;

class Callback extends Model
{
    public function run() {
        return file_get_contents($this->url);
    }
}
