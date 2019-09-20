<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $guarded = [];

    public function area(){
    	return $this->belongsTo('App\Area');
    }
}
