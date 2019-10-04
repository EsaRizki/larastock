<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $guarded = [];

    public function parent()
	{
		return $this->belongsTo(Lokasi::class, 'lokasi_id');
	}

	public function child()
	{
		return $this->hasMany(Lokasi::class);
	}

    public function barangs()
	{
		return $this->hasMany('App\Barang');
	}

	public function stoks()
	{
		return $this->hasMany('App\Stok');
	}
}
