<?php

namespace App\Http\Controllers;

use App\Transaksi;
use Illuminate\Http\Request;
use App\Barang;
use App\Cart;
use Auth;
use PDF;
use App\Stok;
class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::all();
        return view('transaksi.index', compact('transaksi'));
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

    public function checkout(Request $request)
    {
        return view('transaksi.checkout', compact('request'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $cartUser = Cart::where('user_id', Auth::id())->where('status', 0)->get();
        // $data = 1;
        // foreach ($cartUser as $key) {
        //     for ($i=0; $i < count($cartUser); $i++) { 
        //         $min = $key->barang->stock - $key->qty;
        //         if ($min < 0) {
        //           $data = 0;
        //         }
        //     }
        // }
        // if ($data == 0) {
        //     alert()->error("Gagal menyimpan data transaksi", 'Gagal!');
        //     return redirect()->route('barang.index');
        // }

        $this->validate($request, [
            'user_id' => 'required',
            'keterangan'=>'required'
        ]);

       //  $barang = Barang::with('carts')->where('id', $request->barang_id)->get();
       // foreach ($barang as $log) {
       //     $sisa = $log->jumlah - $log->carts->where('status', 1)->sum('qty');
       //     if ($request->qty > $sisa) {
       //         alert()->error("Stok tidak mencukupi", 'Gagal!')->autoclose(2500);
       //          return redirect()->route('barang.index');
       //     }
       // }
        // $barang = Cart::with('barang')->get();
        // dd($barang);
        
        // $cart = Cart::with('barang')->where('status', 0)->get();
        // foreach ($cart as $key) {
        //     $barang = Barang::find($key->barang_id);
        //     $sisa = $barang->carts->sum('qty');
        //     echo "$barang";
        //     echo "$sisa";

        // }
        // dd('stop');

        $transaksi = Transaksi::create([
            'user_id' => $request->user_id,
            'gedung_id' => $request->gedung_id,
            'keterangan'=> $request->keterangan,
        ]);
        for ($i=0; $i < count($request->cart); $i++) { 
            $transaksi->carts()->attach(Cart::find($request->cart[$i]));
            $cart = Cart::find($request->cart[$i]);
            $cart->update([
                'status' => 1,
            ]);
            $stok = Stok::create([
                'barang_id'=> $cart->barang_id,
                'transaksi_id'=> $transaksi->id,
                'qty'=> 0- $cart->qty,
                'sisa'=>$cart->qty,
            ]);
           
        };
        // for ($i=0; $i < count($request->barang_id); $i++) { 
        //     $stok = Stok::create([
        //         'barang_id'=> $request->barang_id,
        //         'transaksi_id'=> $transaksi->id,
        //         'sisa'=>$request->qty,
        //     ]);
        // };

        // for ($i=0; $i < count($request->cart); $i++) { 
        //     $transaksi = Transaksi::find($transaksi->id);
        //     $transaksi->barangs()->attach(Barang::find([$request->cart[$i], ['qty'=>$request->qty]]));
        //     //$transaksi->barangs()->attach($transaksi, ['qty'=>$request->qty]);
        // }
        
        alert()->success("Berhasil menyimpan data transaksi", 'Sukses!');
        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        $pdf = PDF::loadView('transaksi.show', compact('transaksi'));
        return $pdf->stream('unduh.pdf');

        // return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
