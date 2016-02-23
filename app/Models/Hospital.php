<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = ['hospital_name','address','remark'];

    public function wards(){
        return $this->hasMany('App\Models\Ward','hospital_id','id');
    }

    public function isHQ(){
        if($this->hospital_name == "HQ")
            return true;
        else
            return false;
    }
}
