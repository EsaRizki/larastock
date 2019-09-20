<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Cart extends Model
{
    protected $guarded = [];

    public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function barang()
	{
		return $this->belongsTo('App\Barang');
	}

	public function transaksis()
    {
    	return $this->belongsToMany('App\Transaksi');
    }


    public function scopeBorrowed($query)
	{
		return $query->where('status', 1)->sum('qty');
	}
}
