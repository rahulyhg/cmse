<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function role(){
        return $this->hasOne('Spatie\Permission\Models\Role', 'user_id');
    }
}
