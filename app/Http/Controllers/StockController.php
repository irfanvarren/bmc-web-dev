<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\jenisBarang;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = Stock::get();
        $all_jenis = jenisBarang::get();
        $row = $all_jenis->count();
        if($row == 0){
            $row = 1;
        }else{
           $row ++;
        }
        $data = [
            'stock' => $stock,
            'data' => $row,
            'all_jenis' => $all_jenis
        ];
        return view('pages.Stock.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.Stock.create');
    }
    public function add_jenis_barang(Request $req){
        jenisBarang::create($req->all());
        return redirect()->route('stock.index')->withStatus("Jenis Barang berhasil ditambahkan");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        Stock::create($request->all());
        // Stock::insert([
        //     'id_barang' => $request->id_barang,
        //     'nama_barang' => $request->nama_barang,
        //     'stock_barang' => $request->stock_barang,
        //     'jenis_barang' => $request->jenis_barang,
        //     'harga_minimal' => $request->harga_minimal,
        //     'harga_maximal' => $request->harga_maximal,
        //     'satuan' => $request->satuan
        // ]);
        return redirect()->route('stock.index')->withStatus("Barang berhasil dibuat");
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
        $stock = Stock::find($id);
        return view('pages.Stock.edit',compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id_barang;
        Stock::find($id)->update($request->all());
        return redirect()->route('stock.index')->withStatus("Barang berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stock::find($id)->delete();
        return redirect()->route('stock.index')->withStatus("Barang berhasil dihapus");
    }
}
