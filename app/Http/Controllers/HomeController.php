<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lokasi;
use App\Barang;
use App\Stok;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function qr(){
        return view('scanner');
    }
    public function index()
    {
        //dd(Carbon::now()->format('Y-m-d'));

        $lokasis = [];

        $carts = [];
        $barangs = [];
        $data = [];
        $masuk = [];
        $stoks = [];
        $cus = [];
        $total = [];
        foreach (Lokasi::where('lokasi_id', null)->get() as $lokasi) {
            array_push($lokasis, $lokasi->nama);
            array_push($masuk, Stok::where('lokasi_id', $lokasi->id)->where('transaksi_id', null)->whereDate('created_at', Carbon::today())->sum('qty'));
            array_push($data, Stok::where('lokasi_id', $lokasi->id)->where('transaksi_id', '!=', null)->whereDate('created_at', Carbon::today())->sum('qty'));
            array_push($total, Stok::where('lokasi_id', $lokasi->id)->sum('qty'));
            
        }
    //     foreach (Stok::where('transaksi_id', '!=' ,null)->get() as $stok) {
    //     array_push($lokasis, $stok->lokasi->parent->nama);
    //     array_push($carts, $stok->count());
        
    // }
         return view('home', compact('lokasis', 'data', 'stoks', 'carts', 'barangs', 'masuk', 'total'));
    }
}
