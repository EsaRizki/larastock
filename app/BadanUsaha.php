<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BadanUsaha extends Model
{
    public function gedungs(){
    	return $this->hasMany('App\Gedung');
    }
}
