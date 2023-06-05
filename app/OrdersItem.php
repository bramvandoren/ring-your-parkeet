<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ring;


class OrdersItem extends Model
{
  public function ring()
  {
      return $this->belongsTo(Ring::class);
  }
}
