<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public function scopeHidden($query) {
        return $query->where('isHidden', true);
    }

    public function scopeDisplayed($query) {
        return $query->where('isHidden', false);
    }

    public function scopeAvailable($query) {
        return $query->where('isAvailable', true);
    }

    public function scopeNotAvailable($query) {
        return $query->where('isAvailable', false);
    }

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

    static public function getItemsAlphabetical() {
        if(Auth::check()) {
            if(Auth::user()->isDev || Auth::user()->isManager) {
                $items = Items::leftJoin('item_pictures', function($join) {
                    $join->on('items.id', '=', 'item_pictures.itemID')
                            ->where('item_pictures.isFeatured', '=', true);
                })
                ->select('items.*', 'item_pictures.picture')
                ->orderBy('items.name');

                return $items;
            }
        }
        $items = Items::leftJoin('item_pictures', function($join) {
            $join->on('items.id', '=', 'item_pictures.itemID')
                    ->where('item_pictures.isFeatured', '=', true);
        })
        ->select('items.*', 'item_pictures.picture')
        ->orderBy('items.name')
        ->where('items.isHidden', false);

        return $items;
    }
}
