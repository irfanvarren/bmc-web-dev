@extends('layouts.app')
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
                                <th> ID Penjualan </th>
                                <th> ID Toko  </th>
                                <th> Jumlah Produk </th>
                                <th> Tanggal Retur </th>
                                <th> Total Pengiriman </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($all_retur_penjualan) == 0)
                                <tr>
                                    <th colspan="7"> TIDAK ADA DATA</th>
                                </tr>
                            @else
                                @foreach($all_retur_penjualan as $key => $arp)
                                    <tr>
                                        <td> {{$arp->id_retur}} </td>
                                        <td> {{$arp->id_penjualan}} </td>
                                        <td> {{$arp->id_toko_pelanggan}} </td>
                                        <td> {{$arp->jumlah_produk_retur}} </td>
                                        <td> {{$arp->tanggal_retur}} </td>
                                        <td> 00 </td>
                                        <td>
                                            <a href="#" class="float-left btn btn-warning ml-1 text-white"> <i class="fas fa-pencil-alt"></i> </a>
                                            <button onclick="hapus('{{urlencode(urlencode($arp->id_retur))}}')" class="float-left btn btn-danger ml-1"> <i class="fas fa-trash-alt"></i> </button>
                                            <a href="javascript:void(0)" onclick="detail('{{$arp->id_penjualan}}')" class="float-left btn btn-primary ml-1"> <i class="fas fa-info-circle"></i> </a>
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
@include('pages.Retur.modalPenjualan')
@endsection
@push('js')
<script>
        @if(session()->has('status'))
    Swal.fire({
        icon: '{{session()->has("icon") ? session("icon") : "success"}}',
        title: '{{session("judul_alert")}}\n{{session("status")}}',
        showConfirmButton: false,
        timer: 1500
    })
@endif
    function detail(id_penjualan){
        $('#penjualanModal').modal('show');
        $.ajax({
            url : '<?= asset('/adm/retur-penjualan/view') ?>',
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {
                id_penjualan : id_penjualan
            },
            //dataType : 'JSON',
            success:function(data){
                var data_arr = data.split("###");
                var data_retur = JSON.parse(data_arr[1]);
                $('.isi_retur').html(data_arr[0]);

                console.log(data_retur);
                $('.info-retur #id-transaksi').html(data_retur.id_penjualan);
                $('.info-retur #metode-pembayaran').html(data_retur.metode_pembayaran);
                $('.info-retur #tanggal-order').html(data_retur.tanggal_order);
                $('.info-retur #nama-toko').html(data_retur.nama_toko_pelanggan);
                $('.info-retur #alamat-toko').html(data_retur.alamat_toko_pelanggan);
                $('.info-retur #kode_toko').html(data_retur.id_toko_pelanggan);
                $('.info-retur #penanggung_jawab').html(data_retur.penanggung_jawab);
                $('.info-retur #no-hp-penerima').html(data_retur.no_hp);
            }
        });
    }
    function hapus(id_penjualan){
        Swal.fire({
            title: 'Peringatan',
            text: "Data akan terhapus secara permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText : 'Batal'
            }).then((result) => {
            if (result.isConfirmed) {
                location.href="<?= url('/adm/retur-penjualan/') ?>/"+id_penjualan+"/delete";
            }
        })
    }
</script>
@endpush

