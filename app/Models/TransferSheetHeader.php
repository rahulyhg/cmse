<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferSheetHeader extends Model
{
    protected $guarded = [];

    public function items(){
        return $this->hasMany('App\Models\TransferSheetDetail', 'transfer_sheet_id', 'id');
    }

    public function transferTo(){
        return $this->belongsTo('App\Models\Hospital', 'transfer_to');
    }

    public function createdBy(){
        return $this->belongsTo('App\User', 'created_by');
    }

    public function getStatus(){



        if($this->received_at != "0000-00-00 00:00:00" ){
            //return "Delivering <a href='orders/".$data->id."/delivered' class='btn btn-primary btn-xs'>Completed</a>";
            return "Received";
        }else{
            return "Delivering";
        }



    }
}
