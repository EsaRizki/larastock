<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;
class Barang extends Model
{
    protected $guarded = [];

    public function lokasi()
	{
		return $this->belongsTo('App\Lokasi');
	}

	public function kategoris(){
		return $this->belongsTo('App\Kategori');
	}

	public function satuan(){
		return $this->belongsTo('App\Satuan');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function carts()
	{
	return $this->hasMany('App\cart');
	}

	public function stoks()
	{
	return $this->hasMany('App\Stok');
	}

	public function areas()
	{
	return $this->belongsToMany('App\Area')->withPivot('harga');;
	}


	// public function transaksis()
 //    {
 //    	return $this->belongsToMany('App\Transaksi')->withPivot('qty');
 //    }

	public function getStockAttribute()
	{ 
	$borrowed = $this->carts()->borrowed();
	$stock = $this->jumlah - $borrowed;
	return $stock;
	}
}
