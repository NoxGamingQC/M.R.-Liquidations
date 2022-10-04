<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPictures extends Model
{
    protected $table = 'item_pictures';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public static function getAllPictures($id) {
        $pictures = ItemPictures::where('itemID', $id)->orderBy('id')->get(['id', 'picture', 'isFeatured']);

        return $pictures;
    }
}