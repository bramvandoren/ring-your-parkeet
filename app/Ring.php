<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Ring extends Model
{
  protected $fillable = ['inwendige_maat', 'dikte', 'hoogte', 'prijs'];
}
