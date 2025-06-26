<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
   public function message() {
    return $this->belongsTo(User::class);
   }
}
