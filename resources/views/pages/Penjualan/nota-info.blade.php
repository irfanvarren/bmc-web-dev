@extends('layouts.app')

@section('content')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <div class="col-lg-6 float-left">
                        <div>
                            <font class="pl-2 h3">Bless Me Cosmetic </font> <br>
                            <font class="pl-2"> <strong> B M C </strong></font>
                        </div>
                        <div class="pl-2">
                            <font style="font-size: 15px"> PONTIANAK </font>
                        </div>
                    </div>
                    <div class="col-lg-6 float-left text-right">
                        <div class="col-lg-8 float-left text-right">
                            <form action="{{route('simpan_pdf')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id_penjualan" value="{{$id_penjualan}}">
                                <button class="btn btn-danger" type="submit" > <i class="fas fa-file-pdf"></i> Simpan Pdf </a>
                            </form>
                        </div>
                        <div class="col-lg-4 float-left text-right">
                            <form action="{{url('/adm/nota-penjualan/cetak_nota')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id_penjualan" value="{{$id_penjualan}}">
                                <button class="btn btn-warning text-white" type="submit" > <i class="fas fa-print"></i> Print Nota </a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container pt-3">
                    <center>
                        <div class="col-lg-4">
                            <font class="h4"> <strong> NOTA PENJUALAN </strong> </font>
                            <hr>
                        </div>
                    </center>
                </div>
                <div class="container">
                    <div class="col-lg-8 float-left">
                        <table>
                            <tr>
                                <th> No Transaksi </th>
                                <th> :  {{$id_penjualan}} </th>
                            </tr>
                            <tr style="font-size: 14px">
                                <td> Tanggal </td>
                                <td> : {{$all_penjualan[0]['tanggal_kirim']}} </td>
                            </tr>
                            <tr style="font-size: 14px">
                                <td> Cash / Kredit </td>
                                <td> : {{$all_penjualan[0]['metode_pembayaran']}} / JT : 14 </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4 float-left" style="font-size: 14px">
                        <table>
                            <tr>
                                <td> Kode Pelanggan </td>
                                <td> :  {{$all_penjualan[0]['id_toko_pelanggan']}} </td>
                            </tr>
                            <tr>
                                <td> Nama Pelanggan </td>
                                <td> : {{$nama_toko[0]['nama_toko_pelanggan']}} </td>
                            </tr>
                            <tr>
                                <td> Alamat </td>
                                <td> : {{$all_penjualan[0]['alamat_toko_pelanggan']}} </td>
                            </tr>
                        </table>    
                    </div>
                </div>
                <div class="container pt-3">
                    <div class="table-responsive">
                        <table class="table table-bordered w-100">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Nama Barang </th>
                                    <th> Qty </th>
                                    <th> Harga Barang </th>
                                    <th> Satuan </th>
                                    <th> DSC % </th>
                                    <th> DSC RP </th>
                                    <th> Total Harga </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1;$subtotal = 0;$all_diskon = 0?>
                                @foreach($all_detail_penjualan as $adp)
                                    <tr>
                                        <td>{{$row++}}</td>
                                        <td>{{$adp->nama_barang}}</td>
                                        <td>{{$adp->jumlah_barang}}</td>
                                        <td>{{ number_format($adp->harga_barang,0,',','.')}}</td>
                                        <td> {{$adp->satuan}} </td>
                                        <td> {{$adp->diskon."%"}} </td>
                                        <td>{{number_format(($adp->diskon*($adp->harga_barang*$adp->jumlah_barang)/100),0,',','.')}}</td>
                                        <td>{{ number_format(($adp->jumlah_barang*$adp->harga_barang)-(($adp->diskon*($adp->harga_barang*$adp->jumlah_barang)/100)),0,',','.')}}</td>
                                    </tr>
                                    <?php
                                    $subtotal += $adp->jumlah_barang*$adp->harga_barang;
                                    $all_diskon += $adp->diskon*($adp->harga_barang*$adp->jumlah_barang)/100;
                                    ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container pt-2 pb-5">
                    <div class="col-lg-9 float-left">
                        <font style="font-size: 14px"> CATATAN : </font> <br>
                        <font style="font-size: 14px"> 1. Barang yang sudah dibeli tidak dapat dikembalikan kecuali dengan perjanjian  </font> <br>
                        <font style="font-size: 14px"> 2. Pembayaran melalu transfer/cek/giro dianggap lunas jika sudah memasuki rekening kami </font> <br>
                    </div>
                    <div class="col-lg-3 float-left" style="font-size: 14px">
                        <table>
                            <tr>
                                <th> SUB JUMLAH </th>
                                <th> : {{number_format($subtotal,0,',','.')}} </th>
                            </tr>
                            <tr>
                                <th> DISC </th>
                                <th> : {{number_format((($subtotal*$all_penjualan[0]['diskon'])/100),0,',','.')}} ({{$all_penjualan[0]['diskon']."%"}}) </th>
                            </tr>
                            <tr>
                                <th> ALL DISC </th>
                                <th> : {{number_format(((($subtotal*$all_penjualan[0]['diskon'])/100)+$all_diskon),0,',','.')}}  </th>
                            </tr>
                            <tr>
                                <th> TOTAL </th>
                                <th> : {{number_format(($subtotal-(($subtotal*$all_penjualan[0]['diskon'])/100)-$all_diskon),0,',','.')}} </th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="container pt-5 pb-4">
                    <center>
                        <div class="col-lg-6 float-left">
                            <font><b> Penerima </b></font><br><br><br><br>
                            <font>{{$nama_toko[0]['nama_toko_pelanggan']}}</font><br>
                            <font>_______________________</font>
                        </div>
                        <div class="col-lg-6 float-left">
                            <font><b> PENJUAL </b></font><br><br><br><br>
                            <font> BMC </font><br>
                            <font>_________________________</font>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection