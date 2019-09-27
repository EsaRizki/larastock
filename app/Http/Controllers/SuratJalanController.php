<?php

namespace App\Http\Controllers;

use App\suratJalan;
use Illuminate\Http\Request;
use App\Transaksi;
class SuratJalanController extends Controller
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
        $jenis = "SJB";
        if ($request->jenis == 1) {
            $jenis = "SJM";
        }
        $bulan = "I";
        $car = \Carbon\Carbon::now();
        if ($car->month == 1) {
            $bulan = $bulan;
        }elseif ($car->month == 2) {
            $bulan = "II";
        }elseif ($car->month == 3) {
            $bulan = "III";
        }elseif ($car->month == 4) {
            $bulan = "IV";
        }elseif ($car->month == 5) {
            $bulan = "V";
        }elseif ($car->month == 6) {
            $bulan = "VI";
        }elseif ($car->month == 7) {
            $bulan = "VII";
        }elseif ($car->month == 8) {
            $bulan = "VIII";
        }elseif ($car->month == 9) {
            $bulan = "IX";
        }elseif ($car->month == 10) {
            $bulan = "X";
        }elseif ($car->month == 11) {
            $bulan = "XI";
        }elseif ($car->month == 12) {
            $bulan = "XII";
        }
        $transaksi = Transaksi::find($request->transaksi_id);
        $transaksi = $transaksi->gedung->badanUsaha->nama;
        $tahun = substr($car->year, -2);
        $surat = "1/$jenis/$transaksi-SKJ/$bulan/$tahun";
        dd($surat);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\suratJalan  $suratJalan
     * @return \Illuminate\Http\Response
     */
    public function show(suratJalan $suratJalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\suratJalan  $suratJalan
     * @return \Illuminate\Http\Response
     */
    public function edit(suratJalan $suratJalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\suratJalan  $suratJalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, suratJalan $suratJalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\suratJalan  $suratJalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(suratJalan $suratJalan)
    {
        //
    }
}
