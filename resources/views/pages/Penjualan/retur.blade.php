@extends('layouts.app',['title' => 'BMC | Retur Penjualan'])
@section('content')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="container">
                <div class="col-lg-6 float-left">
                    <i class="fas fa-clipboard h3"></i>
                    <font class="pl-3 mb-3 h3"> Retur Penjualan </font> 
                </div>
            </div>
            <div class="col-lg-12"> <hr></div>
            <div class="container">
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <colgroup>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col style="width:15%">
                            <col style="width:16%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th> ID Retur </th>
                                <th> Total Barang Retur </th>
                                <th> Nominal Retur </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($retur_penjualan as $r_p)
                            <tr>
                                <td><{{$r_p->id_retur}}</td>
                                <td></td>
                                <td></td>
                                <td>Edit | Delete</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection