@extends('layouts.app')

@section('content')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <form action="#" name="form_nota" onsubmit="submit_form(event)" method="POST">
            @csrf
            @if(session()->has('permission'))
                <input type="hidden" name="confirm_tambah_barang" id="confirm_tambah_barang" value="0">
            @endif
            <div class="row">
                <div class="container pt-3">
                    <center>
                        <div class="col-lg-4">
                            <font class="h4"> <strong> NOTA PEMBELIAN </strong> </font>
                            <hr>
                        </div>
                    </center>
                </div>
                <div class="container">
                    <div class="col-lg-4 float-left">
                        <table>
                            <tr>
                                <th> No Transaksi </th>
                                <th>  : {{$id_pembelian}} </th>
                            </tr>
                            <tr style="font-size: 14px">
                                <td> Metode Pembayaran </td>
                                <td> : {{$all_pembelian[0]['metode_pembayaran']}}</td>
                            </tr>
                            <tr style="font-size: 14px">
                                <td> Tanggal Order </td>
                                <td>  <input type="text" id="tanggal_order" value="{{$all_pembelian[0]['tanggal_order']}}" class="nota-edited" readonly> </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4 float-left" style="font-size: 14px">
                        <table>
                            <tr>
                                <td> Nama Penerima </td>
                                <td> : {{$all_pembelian[0]['nama_penerima']}} </td>
                            </tr>
                            <tr>
                                <td> No Hp </td>
                                <td> : {{$all_pembelian[0]['no_hp']}} </td>
                            </tr>
                            <tr>
                                <td> Username </td>
                                <td> : {{$all_pembelian[0]['username']}} </td>
                            </tr>
                        </table>    
                    </div>
                    <div class="col-lg-4 float-left" style="font-size: 14px">
                        <table>
                            <tr>
                                <td> Nama Toko </td>
                                <td> : {{$all_pembelian[0]['nama_toko']}} </td>
                            </tr>
                            <tr>
                                <td> Alamat </td>
                                <td> : {{$all_pembelian[0]['alamat_toko']}} </td>
                            </tr>
                            <tr>
                                <td> Ekspedisi </td>
                                <td> : {{$all_pembelian[0]['id_ekspedisi']}} </td>
                            </tr>
                        </table>    
                    </div>
                </div>
                <div class="container pt-3">
                    <div class="table-responsive">
                        <table class="table table-bordered w-100">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> ID Barang </th>
                                    <th> Nama Barang </th>
                                    <th> Qty </th>
                                    <th> Harga Barang </th>
                                    <th> Satuan </th>
                                    <th> Kondisi </th>
                                    <th> Total Harga </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $subtotal = 0;$all_diskon = 0;$row=1;?>
                                @foreach($all_detail_pembelian as $adp)
                                <tr>
                                    <form action="">
                                    <td> {{$row++}} </td>
                                    <td> <input type="text" value="{{$adp->id_barang}}" class="nota-edited" readonly> </td>
                                    <td> <input type="text" value="{{$adp->nama_barang}}" class="nota-edited" readonly> </td>
                                    <td> <input type="text" value="{{$adp->jumlah_barang}}" class="nota-edited" readonly> </td>
                                    <td> <input type="text" value="{{ number_format($adp->harga_barang,0,',','.')}}" class="nota-edited" readonly></td>
                                    <td> <input type="text" value="{{$adp->satuan}}" class="nota-edited" readonly> </td>
                                    <td> <input type="text" value="{{$adp->kondisi}}" class="nota-edited" readonly> </td>
                                    <td> <input type="text" value="{{ number_format($adp->jumlah_barang*$adp->harga_barang,0,',','.')}}" class="nota-edited" readonly></td>
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
                    <div class="col-lg-3 float-left" style="font-size: 14px">
                        <table>
                            <tr>
                                <th> Rasio Ongkir </th>
                                <th> :  {{round($all_pembelian[0]['rasio_ongkir']*100)."%"}} </th>
                            </tr>
                            <tr>
                                <th> Ongkir </th>
                                <th> : {{number_format($all_pembelian[0]['ongkir'],0,',','.')}} </th>
                            </tr>
                            <tr>
                                <th> Potongan Harga  </th>
                                <th> : {{number_format($all_pembelian[0]['potongan_harga'],0,',','.')}} </th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-3 float-left" style="font-size: 14px">
                        <table>
                            <tr>
                                <th> Total Harga </th>
                                <th> : {{number_format($all_pembelian[0]['total_harga'],0,',','.')}} </th>
                            </tr>
                            <tr>
                                <th> Sub Total </th>
                                <th> : {{number_format(($all_pembelian[0]['total_harga']+$all_pembelian[0]['ongkir'])-$all_pembelian[0]['potongan_harga'],0,',','.')}} </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container" style="font-size: 14px">
                <table>
                    <tr>
                        <td> Tanggal Terima : </td>
                        <td>  <input type="text" id="tanggal_baru" value="<?= $all_pembelian[0]['tanggal_terima'] ?>" class="nota-edited" readonly> </td>
                    </tr>
                </table>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
<script type="text/javascript">

</script>
@endpush