<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['auth']], function () {
Route::resource('user', 'UserController');
Route::resource('gedung', 'GedungController');

Route::resource('gudang', 'GudangController');
Route::get('/lokasi/cari/{id}', 'LokasiController@cariLokasi')->name('lokasi.cari');
Route::get('/harga/cari/{id}', 'HargaJualController@cariHarga')->name('harga.cari');
Route::resource('lokasi', 'LokasiController');
Route::resource('kategori', 'KategoriController');
Route::get('barang/habis', [
			'as' => 'barang.habis',
			'uses' => 'BarangController@barangHabis'
		]);
Route::resource('barang', 'BarangController');
Route::get('/stok/index/{id}', 'StokController@index')->name('stok.index');
Route::get('/stok/create/{id}', 'StokController@create')->name('stok.create');
Route::post('/stok', 'StokController@store')->name('stok.store');
// Route::resource('stok', 'StokController');
Route::get('/stok/barang/{barang}/area/{area}', 'StokController@edit')->name('stok.edit');

Route::put('/stok/update/{barang}/area/{area}', 'StokController@update')->name('stok.update');
Route::delete('/stok/{barang}/area/{area}','StokController@destroy')->name('stok.destroy');

Route::get('/harga/index/{id}', 'HargaJualController@hargaJual')->name('harga.jual');
Route::get('/harga/create/{id}', 'HargaJualController@create')->name('harga.create');
Route::post('/harga', 'HargaJualController@store')->name('harga.store');
// Route::resource('harga', 'HargaJualController');
Route::get('/harga/barang/{barang}/area/{area}', 'HargaJualController@edit')->name('harga.edit');

Route::put('/harga/update/{barang}/area/{area}', 'HargaJualController@update')->name('harga.update');
Route::delete('/harga/{barang}/area/{area}','HargaJualController@destroy')->name('harga.destroy');
Route::resource('cart', 'CartController');
Route::resource('transaksi', 'TransaksiController');
Route::get('user/profile/{id}', [
			'as' => 'user.profile',
			'uses' => 'UserController@profile'
		]);
Route::put('user/profileUpdate/{id}', [
			'as' => 'profile.update',
			'uses' => 'UserController@profileUpdate'
		]);
Route::post('chart/add', [
			'as' => 'chart.add',
			'uses' => 'ChartController@add'
		]);
Route::get('barang/keranjang/{$id}', [
			'as' => 'barang.keranjang',
			'uses' => 'BarangController@keranjang'
		]);

Route::get('barang/unduh/{id}', [
			'as' => 'barang.unduh',
			'uses' => 'BarangController@unduh'
		]);
Route::get('barang/allTransaksi/{id}', [
			'as' => 'barang.transaksi',
			'uses' => 'BarangController@allTransaksi'
		]);
});