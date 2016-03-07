<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['item_code','unit','name','barcode','description','cost','gst_code','created_by','updated_by','deleted_by','category_id'];
    protected $hidden = ['cost'];

    public function setBarcodeAttribute($value){

        if(trim($value) == ""){
            $this->attributes['barcode'] = null;
        }else{
            $this->attributes['barcode'] = $value;
        }
    }

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function onhand($hospital_id=false){
        if($hospital_id)
            return $this->hasMany('App\Models\Onhand','item_code', 'item_code')->where('hospital_id','=',$hospital_id);
        else
            return $this->hasMany('App\Models\Onhand','item_code', 'item_code');
    }

    public function getOnHand(){
        $onhand = Onhand::where('item_code','=',$this->item_code)
            ->where('hospital_id','=',Auth::user()->hospital_id)->first();
        if($onhand)
            return $onhand->onhand;
        else
            return 'n/a';
    }

    public function getHqOnHand(){

        $onhand = Onhand::where('item_code','=',$this->item_code)
            ->where('hospital_id','=',Auth::user()->hospital_id)->first();
        if($onhand)
            return $onhand->onhand;
        else
            return 'n/a';
    }




}
