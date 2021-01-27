@extends('layouts.app')

@section('content')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <form action="{{url('adm/nota-pembelian/'.urlencode(urlencode($id_pembelian)).'/retur')}}" name="form_nota" onsubmit="submit_form(event)" method="POST">
            @csrf
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
                            <?php $subtotal = 0;$all_diskon = 0;?>
                                @foreach($all_detail_pembelian as $adp)
                                <tr>
                                    <form action="">
                                    <td> <input type="checkbox" name="id_barang[]" id="{{$adp->id_barang}}" value="{{$adp->id_barang}}" onclick="select_item(this)"> </td>
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
                    <div class="col-lg-6 float-left text-right">
                        <button class="btn btn-primary" type="submit"> Retur Item <li class="fas fa-arrow-right"></li>  </button>
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
@if($icon != "")
    Swal.fire({
      icon: '{{$icon}}',
      title: '{{$judul}}',
      text : '{{$isi}}',
      showConfirmButton: true,
      showCancelButton : true,
      confirmButtonText :'Update sekarang !',
      cancelButtonText : 'Nanti saja',
  }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title : 'Tanggal Terima',
                html :'<input type="date" class="form-control" id="tanggal_terima">',
                showConfirmButton : true,
                showCancelButton : true,
                confirmButtonText : 'Update!',
                cancelButtonText : 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    const tanggal_terima = $('#tanggal_terima').val();
                    const tanggal_order = $('#tanggal_order').val();
                    const id_pembelian = '{{$id_pembelian}}';
                    const tanggal = new Date();
                    const current_date = formatDate(tanggal);
                    if(tanggal_terima > current_date){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Tanggal terima salah',
                        })
                        $('#tanggal_terima').val("");
                    }
                    if(tanggal_terima < tanggal_order){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Tanggal terima salah',
                        })
                        $('#tanggal_terima').val("");
                    }
                    $.ajax({
                        url : '<?= asset('/adm/nota-pembelian/ubah_tanggal') ?>',
                        data : {
                            tanggal_terima : tanggal_terima,
                            id_pembelian : id_pembelian
                        },
                        method : 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType : 'JSON',
                        success:function(data){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Tanggal terima sudah diupdate',
                            })
                            $('#tanggal_baru').val(data);
                        }
                    });
                }
            })
        }
    })
@endif
@if($icon == "error")
    Swal.fire({
        icon: '{{$icon}}',
        title: '{{$judul}}',
        text : '{{$isi}}',
        showConfirmButton: true,
    }).then((result) => {
        if(result.isConfirmed){
            location.href="<?= asset('/adm/nota-pembelian')?>";
        }else{
            location.href="<?= asset('/adm/nota-pembelian')?>";
        }
    })
@endif
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [year, month, day].join('-');
    }
    var hitung_select = 0;
    function select_item(item){
        if(item.checked == true){
            hitung_select += 1;
        }else{
            hitung_select -= 1;
        }
    }
    function submit_form(e){
        e.preventDefault();
        const tanggal_terima = $('#tanggal_baru').val();
        if(hitung_select <= 0){
            Swal.fire({
                icon: 'error',
                title: 'Peringatan',
                text : 'Anda belum memilih produk apapun',
                showConfirmButton: false,
                timer : 1500
            });
        }else if(tanggal_terima == ""){
            Swal.fire({
                icon: 'error',
                title: 'Peringantan',
                text : 'Anda belum bisa melakukan retur',
                showConfirmButton: false,
                timer : 2500
            });
        }else{
            document.form_nota.submit();
        }
    }
    @if(session()->has('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text : '{{session("error")}}',
        showConfirmButton: false,
        timer: 1500
    });
    @endif
    @if(session()->has('permission'))

    var items = {!!json_encode(session('items'))!!};
    console.log(items);
    items.forEach(function(i){
    document.getElementById(i).checked = true;
    });
    Swal.fire({
        icon: 'error',
        title: 'Konfirmasi',
        text : '{{session("permission")}}',
        showConfirmButton: true,
        showCancelButton : true,
        confirmButtonText : 'Tambah Data',
        cancelButtonText : 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#confirm_tambah_barang').val(1);
            document.form_nota.submit();  
        }else{
            $('#confirm_tambah_barang').val(0);
        }
    })

    @endif
    @if(session()->has('status'))
    Swal.fire({
        icon: 'success',
        title: '{{session("status")}}',
        text : 'Apakah anda ingin memilih nota lain ?',
        showConfirmButton: true,
        showCancelButton : true,
        confirmButtonText : 'Ya, tentu saja!',
        cancelButtonText : 'Tidak, kembali ke Nota'
    }).then((result) => {
        if (result.isConfirmed) {
            location.href="{{asset('/adm/nota-pembelian')}}";
        }else{
            location.href="{{asset('/adm/pembelian')}}";
        }
    })
    @endif
</script>
@endpush