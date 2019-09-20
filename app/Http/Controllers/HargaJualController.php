<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Area;
class HargaJualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cariHarga($id)
    {
        $barang = Barang::findOrFail($id);
      
        return $barang->areas->find(Input::get('area_id'));
        
        // return view('lokasi.index', compact('lokasi'));
    }
    public function index()
    {
        //
    }

    public function hargaJual($id)
    {
        $barang = Barang::findOrFail($id);
        $area = Area::all();
        return view('harga.hargaJual', compact('barang', 'area'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $barang = Barang::findOrFail($id);
        $area = Area::all();
        return view('harga.create', compact('barang', 'area'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barang = Barang::find($request->barang_id);
        $barang->areas()->attach(Area::find($request->area_id), ['harga' => $request->harga]);
        alert()->success("Berhasil menyimpan data nilai tiket $barang->nama", 'Sukses!');
        return redirect()->route('harga.jual', $barang);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($barang, $area)
    {
        $barang = Barang::find($barang);
        $area = Area::find($area);
        //dd($barang->areas->find($area)->pivot);
        // foreach ($barang->areas as $key) {
        //     # code...
        // dd($key->pivot);
        // }
        return view('harga.edit', compact('barang', 'area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $barang, $area)
    {
        $barang = Barang::find($barang);
        $area = Area::find($area);
        $this->validate($request,[
            'harga' => 'required',
        ]);
        $barang->areas->find($area)->pivot->update($request->all());
        alert()->success("Berhasil mengubah nilai tiket $barang->nama", 'Sukses!')->autoclose(2500);

        return redirect()->route('harga.jual', $barang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($barang, $area)
    {
        $barang = Barang::find($barang);
        $area = Area::find($area);

        $barang->areas->find($area)->pivot->delete();
        alert()->success("Berhasil menghapus nilai tiket $barang->nama", 'Sukses!')->autoclose(2500);

        return redirect()->route('harga.jual', $barang);
    }
}
