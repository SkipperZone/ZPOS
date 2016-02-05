<?php

namespace ZPos;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
     public function user()
    {
        return $this->belongsTo('ZPos\User');
    }
}
