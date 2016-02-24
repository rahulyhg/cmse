<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemTransaction extends Model
{
    protected $guarded = [];

    public function hospital(){
        return $this->belongsTo('App\Models\Hospital','transfer_to');
    }
}
