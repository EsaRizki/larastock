<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Barang;
use Request;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nik','name', 'role_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function barangs()
    {
        return $this->hasMany('App\Barang');
    }


    public function borrow(Request $request, Barang $barang)
    {
    // cek apakah buku ini sedang dipinjam oleh user
    if($this->carts()->where('barang_id',$barang->id)->where('status', 0)->count() > 0
    ) {
    throw new BarangException("$barang->nama sedang Anda pinjam.");
    }
    $cart = Cart::create($request->all());
    return $cart;
    }

    public function transaksis()
    {
        return $this->hasMany('App\Transaksi');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }
}
