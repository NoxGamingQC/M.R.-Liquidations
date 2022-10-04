<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class PageList extends Model
{
    protected $table = 'page_list';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}