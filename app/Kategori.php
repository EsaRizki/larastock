<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $guarded = [];

    public function barangs(){
    	return $this->hasMany('App\Barang');
    }

    public function stoks(){
    	return $this->hasMany('App\Stok');
    }
}
