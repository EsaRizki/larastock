<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suratJalan extends Model
{
    protected $guarded = [];

    public function transaksi(){
    	return $this->belongsTo('App\Transaksi', 'transaksi_id');
    }
}
