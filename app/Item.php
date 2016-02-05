<?php

namespace ZPos;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function kategori()
    {
        return $this->belongsTo('ZPos\ItemGroup','fk_cat');
    }
    
    public function satuan_name()
    {
        return $this->belongsTo('ZPos\Satuan','satuan');
    }

    public function location()
    {
        return $this->belongsTo('ZPos\Location','fk_location');
    }
    public function inventory()
    {
        return $this->hasMany('ZPos\Inventory')->orderBy('id', 'DESC');
    }

    public function receivingtemp()
    {
        return $this->hasMany('ZPos\ReceivingTemp')->orderBy('id', 'DESC');
    }
}
