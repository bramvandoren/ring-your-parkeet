<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrdersItem;

class Order extends Model
{
  public function bestellingenDetail(){
    return $this->hasMany(OrdersItem::class)->with('ringType');
  }
}
