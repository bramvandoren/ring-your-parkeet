<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrdersItem;

class Order extends Model
{
    public function orderItems()
    {
        return $this->hasMany(OrdersItem::class);
    }
}
