<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use App\Lokasi;
use Session;
use Illuminate\Support\Facades\Input;
use Alert;
use File;
use App\Cart;
use QRCode;
use Auth;
use App\Transaksi;
use App\Kategori;
use App\Gedung;
use App\Satuan;
use App\Stok;
use App\Area;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::all();
        $badge = Cart::where('user_id', Auth::id())->get();
        $cartUser = Cart::where('user_id', Auth::id())->where('status', 0)->get();
        $barang = Barang::with('carts', 'user')->where('status', 1)->get();
        $gedung = Gedung::all();

        return view('barang.index', compact('barang', 'cart', 'cartUser', 'badge', 'gedung'));
    }

    public function barangHabis()
    {
        $cart = Cart::all();
        $badge = Cart::where('user_id', Auth::id())->get();
        $data = [];
        $barang = Barang::with('carts', 'user')->where('status', 1)->get();

        return view('barang.habis', compact('barang', 'cart', 'data', 'badge'));
    }

    public function allTransaksi($id){
        $barang = Barang::with('carts', 'user')->find($id);
        $stok = $barang->jumlah;
        $cart = $barang->carts->count();
        // $sisa = $stok - $log->qty;
        
        return view('barang.allTransaksi', compact('barang', 'stok', 'cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function keranjang(Request $request, $id){
        dd($id);
       //  try{
       // // $this->validate($request,[
       // //      'user_id' => 'required|exists:users,id',
       // //      'barang_id'=>'required|exists:barangs,id',
       // //      'qty'=>'required',
       // //  ]);
       // Auth::user()->borrow($id);
       //  alert()->success("Berhasil menambahkan data pada keranjang", 'Sukses!');
       //  } catch (BookException $e) {
       //  alert()->success("Berhasil menambahkan data pada keranjang", 'Sukses!');
       //  }
    
       // // $cart = Cart::create($request->all());
       //  return redirect()->route('barang.index');
    
    }


    public function create()
    {
        $kategori = Kategori::all();
        $lokasi = Lokasi::where('lokasi_id', '!=', null)->get();
        $gudang = Lokasi::where('lokasi_id', null)->get();
        $satuan = Satuan::all();
        return view('barang.create', compact('lokasi', 'gudang', 'kategori', 'satuan'));
    }

    public function unduh($id)
    {
        $filename = "images/$id-qrcode.png";
        QRCode::url(route('barang.show', $id))->setOutfile($filename)->png();
        return response()->download($filename)->deleteFileAfterSend(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->nilaiTiket));
        $jatabek = intval(($request->harga * 1.2)/30);
        $luarKota = intval(($request->harga * 1.25)/30);
        $luarPulau = intval(($request->harga * 1.5)/30);
        
        $atasjatabek = ($jatabek - substr($jatabek, -1)) + 10;
        $bawahjatabek = ($jatabek - substr($jatabek, -1)) + 5;
        
        $atasLuarKota = ($luarKota - substr($luarKota, -1)) + 10;
        $bawahLuarKota = ($luarKota - substr($luarKota, -1)) + 5;
        
        $atasLuarPulau = ($luarPulau - substr($luarPulau, -1)) + 10;
        $bawahLuarPulau = ($luarPulau - substr($luarPulau, -1)) + 5;
        // $harga = $jatabek;
        // if (substr($jatabek, -1) > 5 && substr($jatabek, -1) <= 9) {
        //     $harga = $atasjatabek;
        // }elseif (substr($jatabek, -1) > 0 && substr($jatabek, -1) <= 5){
        //     $harga = $bawahjatabek;
        // }
        // echo "$harga";
        // dd($jatabek);

        $area = count(Area::all());
        
        
        // dd($area);

        // if (substr($luarKota, -1) > 5 && substr($luarKota, -1) <= 9) {
        //     for ($i = 0; $i < ; $i++) {
                    
        //         }    
        // }

        $this->validate($request,[
            'nama'=>'required|unique:barangs',
            'lokasi_id'=>'required|exists:lokasis,id',
            'kategori_id'=>'required|exists:kategoris,id',
            'harga'=> 'required',
            'qty'=>'required',
            'satuan_id' => 'required|exists:satuans,id',
            'foto'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'user_id' => 'required|exists:users,id',
        ]);

        $barang = Barang::create($request->except('foto', 'gudang_id', 'qty', 'nilaiTiket')) ;
        // isi field cover jika ada cover yang diupload
            if ($request->hasFile('foto')) {

            // Mengambil file yang diupload
                $uploaded_foto = $request->file('foto');

            // mengambil extension file
                $extension = $uploaded_foto->getClientOriginalExtension();

            // membuat nama file random berikut extension
                $filename = md5(time()) . '.' . $extension;

            // menyimpan cover ke folder public/img
                $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
                $uploaded_foto->move($destinationPath, $filename);
            // mengisi field cover di barang dengan filename yang baru dibuat
                $barang->foto = $filename;
                

                $barang->save();
            }
            ;
            $stok = Stok::create([
                'barang_id' => $barang->id,
                'qty' => $request->qty,
            ]);
            if (isset($request->nilaiTiket)) {
                
                for ($i = 1; $i <= $area; $i++) {
                    if ($i == 1) {
                    $harga = $jatabek;
                        if (substr($jatabek, -1) > 5 && substr($jatabek, -1) <= 9) {
                            $harga = $atasjatabek;
                        }elseif (substr($jatabek, -1) > 0 && substr($jatabek, -1) <= 5){
                            $harga = $bawahjatabek;
                        }
                    }elseif ($i == 2) {
                        $harga = $luarKota;
                        if (substr($luarKota, -1) > 5 && substr($luarKota, -1) <= 9) {
                            $harga = $atasLuarKota;
                        }elseif (substr($luarKota, -1) > 0 && substr($luarKota, -1) <= 5){
                            $harga = $bawahLuarKota;
                        }
                    }elseif ($i == 3) {
                        $harga = $luarPulau;
                        if (substr($luarPulau, -1) > 5 && substr($luarPulau, -1) <= 9) {
                            $harga = $atasLuarPulau;
                        }elseif (substr($luarPulau, -1) > 0 && substr($luarPulau, -1) <= 5){
                            $harga = $bawahLuarPulau;
                        }
                    }

                    $barang->areas()->attach(Area::find($i), ['harga' => $harga]);
                };
            }
            


        alert()->success("Berhasil menyimpan data $barang->nama", 'Sukses!')->autoclose(2500);
        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $satuan = Satuan::all();
        $kategori = Kategori::all();
        $lokasi = Lokasi::where('lokasi_id', '!=', null)->get();
        $lokasis = Lokasi::with('parent')->get();
        $gudang = Lokasi::where('lokasi_id', null)->get();   
        return view('barang.edit', compact('satuan','lokasis','barang', 'lokasi', 'kategori', 'gudang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $area = count(Area::all());
            if ($barang->areas == '[]') {
                echo "Kosong";
            }
        foreach ($barang->areas as $log) {
            
        echo "$log";
        }

        $this->validate($request,[
            'nama'=>'required',
            'kategori_id'=>'required|exists:kategoris,id',
            'user_id' => 'required|exists:users,id',
            
        ]);
        $barang->update($request->except('foto','qty', 'nilaiTiket'));
        $barang->stoks->first()->update([
            'qty' => $request->qty,
        ]);

        if ($request->hasFile('foto')) {
        // menambil foto yang diupload berikut ekstensinya
        $filename = null;
        $uploaded_foto = $request->file('foto');
        $extension = $uploaded_foto->getClientOriginalExtension();
        // membuat nama file random dengan extension
        $filename = md5(time()) . '.' . $extension;
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        // memindahkan file ke folder public/img
        $uploaded_foto->move($destinationPath, $filename);
        // hapus foto lama, jika ada
        if ($barang->foto) {
        $old_foto = $barang->foto;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $barang->foto;
        try {
        File::delete($filepath);
            } catch (FileNotFoundException $e) {
            // File sudah dihapus/tidak ada
            }
        }
        $barang->foto = $filename;
        $barang->save();
        }

        //Rumus Nilai Tiket
        $jatabek = intval(($request->harga * 1.2)/30);
        $luarKota = intval(($request->harga * 1.25)/30);
        $luarPulau = intval(($request->harga * 1.5)/30);
        
        $atasjatabek = ($jatabek - substr($jatabek, -1)) + 10;
        $bawahjatabek = ($jatabek - substr($jatabek, -1)) + 5;
        
        $atasLuarKota = ($luarKota - substr($luarKota, -1)) + 10;
        $bawahLuarKota = ($luarKota - substr($luarKota, -1)) + 5;
        
        $atasLuarPulau = ($luarPulau - substr($luarPulau, -1)) + 10;
        $bawahLuarPulau = ($luarPulau - substr($luarPulau, -1)) + 5;

        //Rumus Nilai Tiket

        if (isset($request->nilaiTiket)) {
            for ($i = 1; $i <= $area; $i++) {
                    if ($i == 1) {
                    $harga = $jatabek;
                        if (substr($jatabek, -1) > 5 && substr($jatabek, -1) <= 9) {
                            $harga = $atasjatabek;
                        }elseif (substr($jatabek, -1) > 0 && substr($jatabek, -1) <= 5){
                            $harga = $bawahjatabek;
                        }
                    }elseif ($i == 2) {
                        $harga = $luarKota;
                        if (substr($luarKota, -1) > 5 && substr($luarKota, -1) <= 9) {
                            $harga = $atasLuarKota;
                        }elseif (substr($luarKota, -1) > 0 && substr($luarKota, -1) <= 5){
                            $harga = $bawahLuarKota;
                        }
                    }elseif ($i == 3) {
                        $harga = $luarPulau;
                        if (substr($luarPulau, -1) > 5 && substr($luarPulau, -1) <= 9) {
                            $harga = $atasLuarPulau;
                        }elseif (substr($luarPulau, -1) > 0 && substr($luarPulau, -1) <= 5){
                            $harga = $bawahLuarPulau;
                        }
                    }
                    $barang->areas()->detach(Area::find($i));
                    $barang->areas()->attach(Area::find($i), ['harga' => $harga]);
                };
        }
        alert()->success("Berhasil mengubah data $barang->nama", 'Sukses!')->autoclose(2500);
        // Session::flash("flash_notification", [
        //     "level"=>"success",
        //     "message"=>"Berhasil memperbarui data $barang->nama"
        // ]);

        return redirect()->route('barang.index');
    }

    public function updateLokasiBarang(Request $request, Barang $barang)
    {
        $this->validate($request,[
            'barang_id'=>'required|exists:barangs,id',
            'lokasi_id'=>'required|exists:lokasis,id',
            'user_id' => 'required|exists:users,id',
            
        ]);
        $barang->update($request->except('gudang_id', 'nama', 'barang_id'));
        
        alert()->success("Berhasil mengubah data $barang->nama", 'Sukses!')->autoclose(2500);
        // Session::flash("flash_notification", [
        //     "level"=>"success",
        //     "message"=>"Berhasil memperbarui data $barang->nama"
        // ]);

        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        // dd($barang);
        $barang->delete();
        alert()->success("Berhasil menghapus data barang", 'Sukses!')->autoclose(2500);
        return redirect()->route('barang.index');

    }
}
