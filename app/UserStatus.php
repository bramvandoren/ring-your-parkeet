<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserStatus extends Model
{
  protected $table = 'users_status';

  public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function isPaid()
    {
        return $this->status === 'betaald';
    }
}