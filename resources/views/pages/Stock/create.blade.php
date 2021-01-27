@extends('layouts.app',['title' => 'Stock'])
@section('content')
<div class="col-md-12 p-3">
<div class="card">
<div class="card-body">
<h3 class="mb-3">Tambah Stock</h3>
<div class="text-right">
<a class="btn btn-primary" href="{{route('stock.index')}}">Kembali</a>
</div>
<form action="{{route('stock.store')}}" method="POST">
@csrf
<div class="row form-group">
    <div class="col-xl-8">
        <div class="row ">
            <div class="col-xl-4">
                <label for="id_barang">Id Barang</label>
            </div>
            <div class="col-xl-8">
                <input type="text" class="form-control" id="id_barang" name="id_barang" placeholder="Id Barang">
            </div>
        </div>
    </div>
</div>
<div class="row form-group">
    <div class="col-xl-8">
        <div class="row ">
            <div class="col-xl-4">
                <label for="id_barang">Nama Barang</label>
            </div>
            <div class="col-xl-8">
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang">
            </div>
        </div>
    </div>
</div>
<div class="row form-group">
    <div class="col-xl-8">
        <div class="row ">
            <div class="col-xl-4">
                <label for="id_barang">Stock Barang</label>
            </div>
            <div class="col-xl-8">
                <input type="text" class="form-control" id="stock_barang" name="stock_barang" placeholder="Stock Barang">
            </div>
        </div>
    </div>
</div>
<div class="row form-group">
    <div class="col-xl-8">
        <div class="row ">
            <div class="col-xl-4">
                <label for="id_barang">Jenis Barang</label>
            </div>
            <div class="col-xl-8">
                <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" placeholder="Jenis Barang">
            </div>
        </div>
    </div>
</div>
<div class="row form-group">
    <div class="col-xl-8">
        <div class="row ">
            <div class="col-xl-4">
                <label for="id_barang">Harga Minimal</label>
            </div>
            <div class="col-xl-8">
                <input type="text" class="form-control" id="harga_minimal" name="harga_minimal" placeholder="Harga Minimal">
            </div>
        </div>
    </div>
</div>
<div class="row form-group">
    <div class="col-xl-8">
        <div class="row ">
            <div class="col-xl-4">
                <label for="id_barang">Harga Maximal</label>
            </div>
            <div class="col-xl-8">
                <input type="text" class="form-control" id="harga_maximal" name="harga_maximal" placeholder="Harga Maximal">
            </div>
        </div>  
    </div>
</div>
<div class="row">
    <div class="col-xl-8 text-right">
    <button class="btn btn-primary">Simpan</button>
    </div>
</div>
</form>
</div>
</div>
</div>
@endsection