<?php
/**
 * Created by PhpStorm.
 * User: tylergetsay
 * Date: 10/19/15
 * Time: 8:58 PM
 */

namespace App\Extensions;

use Illuminate\Database\Eloquent\Collection;

class CustomCollection extends Collection
{
    public function getSelector(Array $returnArray = [])
    {
        foreach ($this->items as $item) {
            $returnArray[$item->id] = $item->name;
        }
        return $returnArray;
    }

}