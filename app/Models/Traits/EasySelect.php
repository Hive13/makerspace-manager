<?php
/**
 * Created by PhpStorm.
 * User: tylergetsay
 * Date: 10/19/15
 * Time: 8:44 PM
 */

namespace App\Models\Traits;

trait EasySelect
{

    public static function getSelectors()
    {
        foreach (Self::All() as $item) {
            $returnArray[$item->id] = $item->getName();
        }
        return $returnArray;
    }

    public function getName()
    {
        return $this->{$this->displayName};
    }


}