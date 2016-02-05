<?php

use ZPos\LocationMovingItem;

class LocationMovingDetailed {

    public static function moving_detailed($loc_id)
    {
        $MoveItems = LocationMovingItem::where('loc_id', $loc_id)->get();
        return $MoveItems;
    }

}