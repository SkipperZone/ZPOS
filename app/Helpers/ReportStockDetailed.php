<?php

use ZPos\Item;

class ReportStockDetailed {

    public static function item_detailed($group_id, $loc_id)
    {
        $barcode = Session::get('items');
        foreach ($barcode as $key) {
        	$code = $key->barcode;
        }
       if(count($barcode) == 1){
        $StockItems = Item::where('fk_cat', $group_id)->where('fk_location', $loc_id)->where('barcode', $code)->get();
       } else {
        $StockItems = Item::where('fk_cat', $group_id)->where('fk_location', $loc_id)->get();

       }
        if(count($StockItems) > 0){
        return $StockItems;
        } else return $StockItems = array('no' => 'barang kosong');
    }

}