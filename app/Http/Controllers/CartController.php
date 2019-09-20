<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Auth;
use App\Barang;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,[
            'user_id' => 'required|exists:users,id',
            'barang_id'=>'required|exists:barangs,id',
            'qty'=>'required',
        ]);
       
       $data = Cart::with('barang')->where('user_id', Auth::id())->where('barang_id', $request->barang_id)->get();
       foreach ($data as $key) {
           if ($key->status == 0) {
                alert()->error("Anda memiliki barang yang sama pada keranjang", 'Gagal!')->autoclose(2500);
                return redirect()->route('barang.index');        
           }
       }
       $cart = Cart::create($request->all());
       alert()->success("Berhasil menambahkan data pada keranjang", 'Sukses!')->autoclose(2500);
        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        alert()->success("Berhasil menghapus data pada keranjang", 'Sukses!')->autoclose(2500);
        return redirect()->route('barang.index');

    }
}
