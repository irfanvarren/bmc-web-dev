<?php

use Illuminate\Support\Facades\Route;

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
//Route::get('/', [PageController::class,'index']);
   

 Route::get('/',function(){
     return redirect('/adm/login');
 });

Route::get('logout','Auth\LoginController@logout');   

Route::group(['prefix' => 'adm'],function(){


Auth::routes();
Route::get('logout','Auth\LoginController@logout');   

Route::group(['middleware' => 'auth'],function(){

    Route::get('/dashboard', 'dashboardController@index')->name('dashboard');
    Route::get('/dashboard/statistik','dashboardController@statistik');
    
    Route::get('/penjualan', 'PenjualanController@index');
    Route::get('/nota-penjualan','PenjualanController@nota');
    Route::get('/nota-penjualan/{id_penjualan}' , 'PenjualanController@nota_info');
    Route::get('/nota-penjualan/edited/{id_penjualan}','PenjualanController@edit_nota');
    Route::get('/nota-penjualan/{id_penjualan}/delete','PenjualanController@hapus_nota');
    Route::post('/nota-penjualan/{id_penjualan}/pindah-nota','PenjualanController@pindah_nota');
    Route::post('/nota-penjualan/simpan_pdf','PenjualanController@simpan_pdf')->name('simpan_pdf');
    Route::post('/nota-penjualan/cetak_nota', 'PenjualanController@cetak_nota');
    Route::get('/nota-penjualan/{id_penjualan}/cetak_nota', 'PenjualanController@test_cetak_nota');
    Route::post('/nota-penjualan/filter' , 'PenjualanController@filter');
    Route::get('/nota-penjualan/retur/{id_pembelian}', 'PenjualanController@view_retur');
    Route::post('nota-penjualan/simpan_retur', 'PenjualanController@simpan_retur');
    // Route::get('/nota-penjualan/{id_penjualan}/preview-nota','PenjualanController@preview_nota');
    Route::get('/penjualan/detail' , 'PenjualanControlelr@detail');
    Route::post('/penjualan/cek_id' , 'PenjualanController@cek_id');
    Route::post('/penjualan/detail_barang' , 'PenjualanController@detail_barang');
    Route::post('/penjualan/items' , 'PenjualanController@items');
    Route::post('/penjualan/simpan_nota' , 'PenjualanController@simpan_nota');

    Route::get('/toko' , 'TokoController@index')->name('toko.index');
    Route::post('/toko/simpan_data' , 'TokoController@simpan_data');
    Route::post('/toko/ambil_id','TokoController@ambil_id');
    Route::post('/toko/ambil_data' ,'TokoController@ambil_data');
    Route::post('/toko/edit_data', 'TokoController@edit_data');
    Route::delete('/toko/hapus_data', 'TokoController@hapus_data');

    Route::get('/ekspedisi' , 'EkspedisiController@index')->name('ekspedisi.index');
    Route::post('/ekspedisi/simpan_data','EkspedisiController@simpan_data');
    Route::post('/ekspedisi/ambil_data','EkspedisiController@ambil_data');
    Route::post('/ekspedisi/ambil_id','EkspedisiController@ambil_id');
    Route::post('/ekspedisi/edit_data','EkspedisiController@edit_data');
    Route::delete('/ekspedisi/hapus_data','EkspedisiController@hapus_data');
    
    Route::get('/penerima', 'PenerimaController@index');
    Route::post('/penerima/simpan_data', 'PenerimaController@simpan_data');
    Route::post('/penerima/ambil_id' , 'PenerimaController@ambil_id');
    Route::post('/penerima/ambil_data' , 'PenerimaController@ambil_data');
    Route::post('/penerima/edit_data' , 'PenerimaController@edit_data');
    Route::delete('/penerima/hapus_data','PenerimaController@hapus_data');

    Route::get('/profile', 'ProfileController@index');
    Route::post('/jenis-barang', 'StockController@add_jenis_barang');

    Route::get('pembelian','PembelianController@index')->name('pembelian');
    Route::get('/nota-pembelian' , 'PembelianController@nota');
    Route::get('/nota-pembelian/edited/{id_pembelian}' , 'PembelianController@edit_nota')->name('edit-nota');
    Route::get('/nota-pembelian/{id_pembelian}', 'PembelianController@nota_info');
    Route::get('/nota-pembelian/{id_pembelian}/delete','PembelianController@hapus_nota');
    Route::post('/nota-pembelian/ubah_tanggal' , 'PembelianController@ubah_tanggal');
    Route::post('/nota-pembelian/{id_pembelian}/retur','PembelianController@retur_nota');
    Route::get('/nota-pembelian/retur/{id_pembelian}', 'PembelianController@view_retur');
    Route::post('nota-pembelian/simpan_retur', 'PembelianController@simpan_retur');
    Route::post('/nota-pembelian/filter','PembelianController@filter');
    Route::post('/pembelian/dtlid_barang' , 'PembelianController@dtlid_barang');
    Route::post('/pembelian/cek_id' , 'PembelianController@cek_id');
    Route::post('/pembelian/add_items' , 'PembelianController@add_items');
    Route::post('/pembelian/tambah_barang', 'PembelianController@tambah_barang');
    Route::post('/pembelian/simpan_nota','PembelianController@simpan_nota');


    Route::get('p','StockController@index')->name('stock.index');
    Route::post('p/simpan_data','StockController@store')->name('stock.store');
    Route::put('p/edit_data','StockController@update')->name('stock.update');
    Route::delete('p/{p}','StockController@destroy')->name('stock.destroy');
   
    Route::get('/retur-penjualan','PenjualanController@retur_penjualan');
    Route::post('/retur-penjualan/view','PenjualanController@view');
    Route::get('/retur-penjualan/{id_retur}/delete','PenjualanController@hapus_retur');
    Route::post('/retur-pembelian/view', 'PembelianController@view');
    Route::get('/retur-pembelian','PembelianController@retur_pembelian');
    Route::get('/retur-pembelian/{id_retur}/delete','PembelianController@hapus_retur');
    Route::get('/retur-pembelian/{id_retur}/perpanjang','PembelianController@perpanjang_retur');
    Route::get('/retur-pembelian/edit_retur','PembelianController@edit_retur');
    Route::get('akun','AkunController@index')->name('akun.index');
    Route::post('akun/update','AkunController@update')->name('akun.update');
    Route::post('akun/update/profile','AkunController@update_profile')->name('akun.update.profile');
    Route::delete('akun/{id}','AkunController@delete')->name('akun.delete');
});


});







