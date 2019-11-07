<?php

namespace App\Http\Controllers;

use App\Lokasi;
use Illuminate\Http\Request;
use Session;
use Excel;
use App\Jobs\ImportJob;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cariLokasi($id)
    {
        return Lokasi::where('lokasi_id', $id)->pluck('nama', 'id');
        
        // return view('lokasi.index', compact('lokasi'));
    }

    public function generateExcelTemplate(){

    }

    public function importLokasi(Request $request)
    {
        dd($request->all());
        //VALIDASI
        $this->validate($request, [
            'import' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('import')) {
            $file = $request->file('import'); //GET FILE
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs(
                'public', $filename
            );
            //MEMBUAT JOBS DENGAN MENGIRIMKAN PARAMETER FILENAME
            ImportJob::dispatch($filename); 
            return redirect()->back()->with(['success' => 'Upload success']);
        }  
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    public function index()
    {
        $lokasi = Lokasi::where('lokasi_id', '!=', null)->get();
        return view('lokasi.index', compact('lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lokasi = Lokasi::where('lokasi_id', null)->get();
        return view('lokasi.create', compact('lokasi'));
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
            'lokasi_id' => 'required|exists:lokasis,id',
            'nama'=>'required|unique:lokasis',
        ]);

        $lokasi = Lokasi::create($request->all());
        // Session::flash("flash_notification", [
        //     "level"=>"success",
        //     "message"=>"Berhasil menyimpan $lokasi->nama"
        // ]);
        alert()->success("Berhasil menyimpan data $lokasi->nama", 'Sukses!')->autoclose(2500);
        return redirect()->route('lokasi.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Lokasi $lokasi)
    {  
        

        return view('lokasi.edit', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        $lokasi->update($request->all());
        alert()->success("Berhasil mengubah data $lokasi->nama", 'Sukses!')->autoclose(2500);

        return redirect()->route('lokasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();
        alert()->success("Berhasil menghapus data lokasi", 'Sukses!')->autoclose(2500);
        return redirect()->route('lokasi.index');

    }
}
