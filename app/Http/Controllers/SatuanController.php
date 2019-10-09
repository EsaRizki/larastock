<?php

namespace App\Http\Controllers;

use App\satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = satuan::all();
        return view('satuan.index', compact('satuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('satuan.create');
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
        ]);

        $satuan = satuan::create($request->all());

        alert()->success("Berhasil menyimpan data $satuan->nama", 'Sukses!')->autoclose(2500);
        return redirect()->route('satuan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function show(satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function edit(satuan $satuan)
    {
        return view('satuan.edit', compact('satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, satuan $satuan)
    {
        $this->validate($request,[
            'nama'=>'required|unique:satuans',
        ]);

        $satuan->update($request->all());
        // Session::flash("flash_notification", [
        //     "level"=>"success",
        //     "message"=>"Berhasil menyimpan $lokasi->nama"
        // ]);
        alert()->success("Berhasil mengubah data $satuan->nama", 'Sukses!')->autoclose(2500);
        return redirect()->route('satuan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(satuan $satuan)
    {
        $satuan->delete();
        alert()->success("Berhasil menghapus data", 'Sukses!')->autoclose(2500);
        return redirect()->route('satuan.index');
    }
}
