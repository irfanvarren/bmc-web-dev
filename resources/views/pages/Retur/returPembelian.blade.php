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
                            <colgroup>
                                <col>
                                <col>
                                <col>
                                <col style="width:8%">
                                <col>
                                <col>
                                <col style="width:10%">
                                <col style="width:10%">
                                <col>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th> ID Retur </th>
                                    <th> ID Pembelian </th>
                                    <th> ID Akun  </th>
                                    <th> Jumlah Produk </th>
                                    <th> Tanggal Terima </th>
                                    <th> Tanggal Retur </th>
                                    <th> Tanggal Perpanjang </th>
                                    <th> Total Pengiriman </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($all_retur_pembelian) == 0)
                                <tr>
                                    <th colspan="8"> TIDAK ADA DATA</th>
                                </tr>
                                @else
                                @foreach($all_retur_pembelian as $key => $arp)
                                <tr>
                                    <td> {{$arp->id_retur}} </td>
                                    <td> {{$arp->id_pembelian}} </td>
                                    <td> {{$arp->id_akun}} </td>
                                    <td> {{$arp->jumlah_produk_retur}} </td>
                                    <td> {{$arp->tanggal_terima}} </td>
                                    <td> {{$arp->tanggal_retur}} </td>
                                    <td> {{$arp->tanggal_perpanjang == NULL ? "-" : $arp->tanggal_perpanjang}} </td>
                                    <td> 
                                        @php
                                            if($arp->tanggal_perpanjang != ""){
                                                $total_pengiriman = date_diff(date_create($arp->tanggal_perpanjang),date_create( $arp->tanggal_terima))->d;
                                            }else{
                                                $total_pengiriman = 0;
                                            }
                                        @endphp
                                        {{str_pad($total_pengiriman,2,"0",STR_PAD_LEFT)}}
                                    </td>
                                    <td>
                                        @php
                                            if($arp->tanggal_perpanjang != ""){
                                                $tanggal_baru = $arp->tanggal_perpanjang;
                                            }else{
                                                $tanggal_baru = $arp->tanggal_retur;
                                            }
                                            $tanggal_max = date_create($arp->tanggal_retur);
                                            $tanggal_perpanjang =  date_create($tanggal_baru);

                                            date_add($tanggal_perpanjang , date_interval_create_from_date_string('3 days'));
                                            date_add($tanggal_max , date_interval_create_from_date_string('9 days'));
                                        @endphp
                                        <a href="javascript:void(0)" onclick="edt('{{urlencode(urlencode($arp->id_retur))}}','{{date_format($tanggal_perpanjang, "d/m/Y")}}','{{$tanggal_perpanjang <= $tanggal_max ? 0 : 1}}')" class="float-left btn btn-warning ml-1 text-white"> <i class="fas fa-pencil-alt"></i> </a>
                                        <button class="float-left btn btn-danger ml-1" onclick="hapus('{{urlencode(urlencode($arp->id_retur))}}')"> <i class="fas fa-trash-alt"></i> </button>
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
    @if(session()->has('status'))
    Swal.fire({
        icon: '{{session()->has("icon") ? session("icon") : "success"}}',
        title: '{{session("judul_alert")}}\n{{session("status")}}',
        showConfirmButton: false,
        timer: 1500
    })
    @endif
    function edt(id_retur,tanggal_perpanjang,cek_max_retur){
        console.log(cek_max_retur);
        if(cek_max_retur == 1){
           var title = "Error";
           var text = "Retur hanya bisa 3 kali"
           var icon = "error";
           Swal.fire({
            icon: icon,
            title: title,
            text: text,
            showConfirmButton: false,
            timer: 1500
        })
       }else{
           var title = "Perpanjang tanggal retur ?";
           var text = "Jika kamu belum menerima produk, silakan perpanjang masa selama 3 hari. jika produk yang diterima tidak sesuai/lengkap/rusak, silakan ajukan pengembalian barang/dana sebelum "+tanggal_perpanjang;
           var icon = "warning";
           Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok',
            cancelButtonText : 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href="<?= url('/adm/retur-pembelian/') ?>/"+id_retur+"/perpanjang?tanggal_perpanjang="+tanggal_perpanjang;
            }
        });

    }

        // $.ajax({
        //     url : '<?= asset('/adm/retur-pembelian/edit_retur') ?>',
        //     method : 'POST',
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     data : {
        //         id_pembelian : id_pembelian
        //     },
        //     //dataType : 'JSON',
        //     success:function(data){
        //         alert(data);
        //         console.log(data);  
        //     }
        // });
    }
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
                location.href="<?= url('/adm/retur-pembelian/') ?>/"+id_penjualan+"/delete";
            }
        })
    }
</script>
@endpush

