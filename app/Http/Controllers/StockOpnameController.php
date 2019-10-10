<?php

namespace App\Http\Controllers;

use App\stockOpname;
use Illuminate\Http\Request;
use App\Barang;
use App\Cart;
use Auth;
class StockOpnameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $badge = Cart::where('user_id', Auth::id())->where('status', 3)->get();
        $cart = Cart::where('status', 3)->get();
        if ($cart == "[]") {
            $barang = Barang::all();
        }
        foreach ($cart as $log) {
            $barang = Barang::where('id', '!=', $log->barang_id)->get();
            echo "$barang";
        }
        dd($barang);

        return view('so.index', compact('barang', 'cart', 'badge'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        return view('so.create', compact('barang'));
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
           if ($key->status == 3) {
                alert()->error("Anda memiliki barang yang sama pada keranjang", 'Gagal!')->autoclose(2500);
                return redirect()->route('so.index');        
           }
       }

       $cart = Cart::create([
        'user_id' => $request->user_id,
        'barang_id' => $request->barang_id,
        'qty' => $request->qty,
        'status' => 3,
        'keterangan' => $request->keterangan,
       ]);
       alert()->success("Berhasil menambahkan data pada keranjang", 'Sukses!')->autoclose(2500);
        return redirect()->route('so.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\stockOpname  $stockOpname
     * @return \Illuminate\Http\Response
     */
    public function show(stockOpname $stockOpname)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\stockOpname  $stockOpname
     * @return \Illuminate\Http\Response
     */
    public function edit(stockOpname $stockOpname)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\stockOpname  $stockOpname
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, stockOpname $stockOpname)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\stockOpname  $stockOpname
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        alert()->success("Berhasil menghapus data pada keranjang", 'Sukses!')->autoclose(2500);
        return redirect()->route('so.index');
    }
}
