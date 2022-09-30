<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';

    static public function getHiddenItemsCount($items) {
        $itemCount = 0;
        foreach($items as $key => $item) {
            if($item->isHidden) {
                $itemCount =+ 1;
            }
        }

        return $itemCount;
    }

    static public function getDisplayedItemCount($items) {
        $totalCount = count($items);
        $hiddenCount = Items::getHiddenItemsCount($items);
        
        return ($totalCount - $hiddenCount);
    }
}
