<?php

namespace ZPos;

use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    protected $table = 'item_group';

    public function item()
    {
        return $this->hasMany('App\Item')->orderBy('id', 'DESC');
    }
}
