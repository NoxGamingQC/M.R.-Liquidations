<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerOrders extends Model
{
    protected $table = 'customer_orders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
