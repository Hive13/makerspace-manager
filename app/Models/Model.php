<?php
/**
 * Created by PhpStorm.
 * User: tylergetsay
 * Date: 10/19/15
 * Time: 8:57 PM
 */

namespace App\Models;

use App\Extensions\CustomCollection;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    public function newCollection(array $models = Array())
    {
        return new CustomCollection($models);
    }


}

