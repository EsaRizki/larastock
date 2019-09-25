<?php

namespace App\Http\Controllers;

use App\Gedung;
use Illuminate\Http\Request;
use App\Area;
use App\BadanUsaha;
class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gedung = Gedung::all();
        return view('gedung.index', compact('gedung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area = Area::all();
        $badanUsaha = BadanUsaha::all();
        return view('gedung.create', compact('area', 'badanUsaha'));
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
            'nama'=>'required',
            'area'=>'required|exists:areas,id',
            'badanUsaha'=>'required|exists:badan_usahas,id',
            'alamat'=>'required',
        ]);

        $gedung = Gedung::create([
            'nama' => $request->nama,
            'badan_usaha_id' => $request->badanUsaha,
            'area_id' => $request->area,
            'alamat' => $request->alamat,
        ]);

        alert()->success("Berhasil menyimpan data $gedung->nama", 'Sukses!')->autoclose(2500);
        return redirect()->route('gedung.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function show(Gedung $gedung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function edit(Gedung $gedung)
    {
        $badanUsaha = BadanUsaha::all();
        $area = Area::all();
        return view('gedung.edit', compact('gedung', 'badanUsaha', 'area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gedung $gedung)
    {
        $gedung->update([
            'nama' => $request->nama,
            'badan_usaha_id' => $request->badanUsaha,
            'area_id' => $request->area,
            'alamat' => $request->alamat,
        ]);
        alert()->success("Berhasil mengubah data $gedung->nama", 'Sukses!')->autoclose(2500);

        return redirect()->route('gedung.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gedung $gedung)
    {
        $gedung->delete();
        alert()->success("Berhasil menghapus data", 'Sukses!')->autoclose(2500);
        return redirect()->route('gedung.index');
    }
}
