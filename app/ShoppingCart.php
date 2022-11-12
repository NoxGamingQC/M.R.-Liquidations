<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_cart';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function scopeGetItems($query) {
        return $query->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'shopping_cart.item_id');
        })->select('shopping_cart.id', 'items.name', 'shopping_cart.quantity', 'items.price');
    }

}