<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class satuan extends Model
{
    protected $guarded = [];
    public function barangs(){
    	return $this->hasMany('App\Barang');
    }
}
