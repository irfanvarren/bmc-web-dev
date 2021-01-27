@extends('layouts.app')
@section('content')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="container">
                <div class="col-lg-6 float-left">
                    <i class="fas fa-clipboard h3"></i>
                    <font class="pl-3 mb-3 h3"> Retur Pembelian </font> 
                </div>
                <div class="col-lg-6 float-left">
                    <div class="mb-3 text-right">
                        Tanggal : {{date("d/m/Y")}}
                    </div>
                </div>
            </div>
            <div class="col-lg-12"> <hr></div>
            <div class="container">
                <div class="table-responsive mt-3">
                    <table class="table table-bordered" style="text-align:center">
                        <thead>
                            <tr>
                                <th> ID Retur </th>
                                <th> ID Pembelian </th>
                                <th> ID Akun  </th>
                                <th> Jumlah Produk </th>
                                <th> Tanggal Retur </th>
                                <th> Tanggal Perpanjang </th>
                                <th> Total Pengiriman </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($all_retur_pembelian) == 0)
                                <tr>
                                    <th colspan="7"> TIDAK ADA DATA</th>
                                </tr>
                            @else
                                @foreach($all_retur_pembelian as $key => $arp)
                                    <tr>
                                        <td> {{$arp->id_retur}} </td>
                                        <td> {{$arp->id_pembelian}} </td>
                                        <td> {{$arp->id_akun}} </td>
                                        <td> {{$arp->jumlah_produk_retur}} </td>
                                        <td> {{$arp->tanggal_retur}} </td>
                                        <td> {{$arp->tanggal_perpanjang == NULL ? "-" : $arp->tanggal_perpanjang}} </td>
                                        <td> 00 </td>
                                        <td>
                                            <a href="#" class="float-left btn btn-warning ml-1 text-white"> <i class="fas fa-pencil-alt"></i> </a>
                                            <a href="" class="float-left btn btn-danger ml-1"> <i class="fas fa-trash-alt"></i> </a>
                                            <a href="javascript:void(0)" onclick="detail('{{$arp->id_pembelian}}')" class="float-left btn btn-primary ml-1"> <i class="fas fa-info-circle"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.Retur.modalPembelian')
@endsection
@push('js')
<script>
    function detail(id_pembelian){
        $('#pembelianModal').modal('show');
        $.ajax({
            url : '<?= asset('/adm/retur-pembelian/view') ?>',
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {
                id_pembelian : id_pembelian
            },
            //dataType : 'JSON',
            success:function(data){
                var data_arr = data.split("###");
                var data_retur = JSON.parse(data_arr[1]);
                $('.isi_retur').html(data_arr[0]);

                console.log(data_retur);
                $('.info-retur #id-transaksi').html(data_retur.id_pembelian);
                $('.info-retur #metode-pembayaran').html(data_retur.metode_pembayaran);
                $('.info-retur #tanggal-order').html(data_retur.tanggal_order);
                $('.info-retur #nama-toko').html(data_retur.nama_toko);
                $('.info-retur #alamat-toko').html(data_retur.alamat_toko);
                $('.info-retur #ekspedisi').html(data_retur.nama_ekspedisi);
                $('.info-retur #username').html(data_retur.username);
                $('.info-retur #penerima').html(data_retur.nama_penerima);
                $('.info-retur #no-hp-penerima').html(data_retur.no_hp);
            }
        });
    }
</script>
@endpush

