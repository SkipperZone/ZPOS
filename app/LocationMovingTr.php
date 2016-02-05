<?php

namespace ZPos;

use Illuminate\Database\Eloquent\Model;

class LocationMovingTr extends Model
{
    protected $table = 'location_move_tr';

    public function loc_from_rel()
    {
        return $this->belongsTo('ZPos\Location','loc_from');
    }

    public function loc_to_rel()
    {
        return $this->belongsTo('ZPos\Location','loc_to');
    }
}
