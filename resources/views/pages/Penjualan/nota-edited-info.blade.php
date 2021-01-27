@extends('layouts.app')

@section('content')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <form action="{{url('adm/nota-penjualan/'.urlencode(urlencode($id_penjualan)).'/pindah-nota')}}" name="form_nota" method="POST">
            @csrf
            @if(session()->has('permission'))
                <input type="hidden" name="confirm_tambah_barang" id="confirm_tambah_barang" value="1">
            @endif
            <div class="row">
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
                            {{-- <colgroup>
                                <col>
                                <col style="width: 18%">
                                <col style="width: 5%">
                                <col style="width: 15%">
                                <col style="width: 5%">
                                <col style="width: 8%">
                                <col style="width: 8%">
                                <col style="width: 15%">
                                <col>
                            </colgroup> --}}
                            <thead>
                                <tr>
                                    <th> # </th>
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
                            <?php $subtotal = 0;$all_diskon = 0;?>
                                @foreach($all_detail_penjualan as $adp)
                                <tr>
                                    <td> <input type="checkbox" name="id_barang[]" id="{{$adp->id_barang}}"  value="{{$adp->id_barang}}" onclick="select_item(this)"> </td>
                                    <td> <input type="text" value="{{$adp->nama_barang}}" class="nota-edited" readonly> </td>
                                    <td> <input type="text" value="{{$adp->jumlah_barang}}" class="nota-edited" readonly> </td>
                                    <td> <input type="text" value="{{ number_format($adp->harga_barang,0,',','.')}}" class="nota-edited" readonly></td>
                                    <td> <input type="text" value="{{$adp->satuan}}" class="nota-edited" readonly> </td>
                                    <td> <input type="text" value="{{$adp->diskon."%"}}" class="nota-edited" readonly> </td>
                                    <td> <input type="text" value="{{number_format(($adp->diskon*($adp->harga_barang*$adp->jumlah_barang)/100),0,',','.')}}" class="nota-edited" readonly></td>
                                    <td> <input type="text" value="{{ number_format(($adp->jumlah_barang*$adp->harga_barang)-($adp->diskon*($adp->harga_barang*$adp->jumlah_barang)/100),0,',','.')}}" class="nota-edited" readonly></td>
                                </tr>
                                <?php
                                    $subtotal += $adp->jumlah_barang*$adp->harga_barang;
                                    $all_diskon += $adp->diskon*($adp->harga_barang*$adp->jumlah_barang)/100;
                                ?>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th> Ket </th>
                                    <td colspan="7"> {{$all_penjualan[0]['keterangan']}} </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="container pt-2 pb-5">
                    <div class="col-lg-3 float-left" style="font-size: 14px">
                        <table>
                            <tr>
                                <th> SUB JUMLAH </th>
                                <th> : {{number_format($subtotal,0,',','.')}} </th>
                            </tr>
                            <tr>
                                <th> DISC </th>
                                <th> :  {{number_format((($subtotal*$all_penjualan[0]['diskon'])/100),0,',','.')}} ({{$all_penjualan[0]['diskon']."%"}})  </th>
                            </tr>
                            <tr>
                                <th> TOTAL </th>
                                <th> : {{number_format(($subtotal-(($subtotal*$all_penjualan[0]['diskon'])/100)-$all_diskon),0,',','.')}} </th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-9 float-left text-right">
                        <input type="hidden" name="move_retur" id="move_retur">
                        <button type="submit" class="btn btn-primary"  onclick="submit_form(event,'add_item')"> Pindah ke Nota Baru <li class="fas fa-arrow-right"></li>  </button>
                        <button type="submit" class="btn btn-danger"  onclick="submit_form(event,'retur_item')"> <i class="fas fa-exchange-alt"></i> Retur Barang </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>

    var hitung_select = 0;
    function select_item(item){
        if(item.checked == true){
            hitung_select += 1;
        }else{
            hitung_select -= 1;
        }
    }
    function submit_form(e,btn){
        console.log(btn);
        $('#move_retur').val(btn);
        e.preventDefault();

        if(hitung_select <= 0){
            Swal.fire({
                icon: 'error',
                title: 'Peringatan',
                text : 'Anda belum memilih produk apapun',
                showConfirmButton: false,
                timer : 1500
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
            timer: 2500
        });
    @endif
    @if(session()->has('permission'))
        var items = {!!json_encode(session('items'))!!};
        $('#move_retur').val("{{session('previous_cmd')}}");
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
                location.href="{{asset('/adm/nota-penjualan')}}";
            }else{
                location.href="{{asset('/adm/penjualan')}}";
            }
        })
    @endif
</script>
@endpush