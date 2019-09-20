<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = [];

    public function gedungs(){
    	return $this->hasMany('App\Gedung');
    }

    public function barangs(){
    	return $this->belongsToMany('App\Barang')->withPivot('harga');;
    }
}
