<?php namespace ZPos;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {

	public function user()
    {
        return $this->belongsTo('ZPos\User');
    }
    public function customer()
    {
        return $this->belongsTo('ZPos\Customer');
    }

}
