<?php

namespace ZPos;

use Illuminate\Database\Eloquent\Model;

class LocationMovingItem extends Model
{
    protected $table = 'location_move_items';

    public function item()
    {
        return $this->belongsTo('ZPos\Item','item_id');
    }

    public function satuan_name()
    {
        return $this->belongsTo('ZPos\Satuan');
    }
    // public function loc_to_rel()
    // {
    //     return $this->belongsTo('ZPos\Location','loc_to');
    // }
}
