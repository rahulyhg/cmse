<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Onhand extends Model
{
    protected $guarded = [];

    public function hospital(){
        return $this->belongsTo('App\Models\hospital','hospital_id');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item','item_code','item_code');
    }
}
