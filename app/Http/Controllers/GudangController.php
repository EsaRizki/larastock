<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lokasi;
use Session;
class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasi = Lokasi::where('lokasi_id', null)->get();
        return view('gudang.index', compact('lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gudang.create');
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
            'nama'=>'required|unique:lokasis',
        ]);

        $gudang = Lokasi::create($request->all());

        alert()->success("Berhasil menyimpan data $gudang->nama", 'Sukses!')->autoclose(2500);
        return redirect()->route('gudang.index');
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
    public function edit($id)
    {
        $gudang = Lokasi::findOrFail($id);
        return view('gudang.edit', compact('gudang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $gudang)
    {
        $gudang->update($request->all());
        alert()->success("Berhasil mengubah data $gudang->nama", 'Sukses!')->autoclose(2500);

        return redirect()->route('gudang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gudang = Lokasi::findOrFail($id);
        $gudang->delete();
        alert()->success("Berhasil menghapus data gudang", 'Sukses!')->autoclose(2500);
        return redirect()->route('gudang.index');
    }
}
