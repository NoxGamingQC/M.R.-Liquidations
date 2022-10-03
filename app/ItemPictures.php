<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPictures extends Model
{
    protected $table = 'item_pictures';

    public static function getAllPictures($id) {
        $pictures = ItemPictures::where('itemID', $id)->get(['picture']);

        return $pictures;
    }
}