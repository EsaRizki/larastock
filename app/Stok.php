<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $guarded = [];

    public function barangs(){
    	return $this->belongsTo('App\Barang');
    }
}
