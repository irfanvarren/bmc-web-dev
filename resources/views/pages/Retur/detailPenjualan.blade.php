@extends('layouts.app')

@section('content')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="container pt-3">
                    <div class="col-lg-8 float-left">
                        <font class="pl-2 h3">Bless Me Cosmetic </font> <br>
                        
                    </div>
                    <div class="col-lg-4 float-left text-right">
                        <font class="h3"> <strong> RETUR Penjualan </strong> </font> <br>
                        <font class="pl-2"> <strong> B M C </strong></font>
                    </div>
                </div>
                <div class="container">
                    <div class="col-lg-12"> <hr></div>
                </div>
                <div class="container">
                    <div class="col-lg-4 float-left">
                        <table>
                            <table>
                                <tr>
                                    <td> Nomor Transaksi  </td>
                                    <td class="pl-2 pr-2"> : </td>
                                    <td> <input type="text" value="{{$id_transaksi}}" id="id_transaksi" class="nota-edited" readonly></td>
                                </tr>
                                <tr>
                                    <td> Tanggal  </td>
                                    <td class="pl-2 pr-2"> : </td>
                                    <td> <input type="text" value="{{date("d/m/Y")}}" id="tanggal_retur" class="nota-edited" readonly></td>
                                </tr>
                            </table>
                        </table>
                    </div>
                    <div class="col-lg-4 float-left">
                        <table>
                            <table>
                                <tr>
                                    <td> Nama Toko  </td>
                                    <td class="pl-2 pr-2"> : </td>
                                    <input type="hidden" value="{{$all_penjualan[0]['id_toko_pelanggan']}}" id="id_toko_pelanggan">
                                    <td> <input type="text" value="{{$all_penjualan[0]['nama_toko_pelanggan']}}" id="nama_toko" class="nota-edited" readonly></td>
                                </tr>
                                <tr>
                                    <td> Alamat Toko  </td>
                                    <td class="pl-2 pr-2"> : </td>
                                    <td> <input type="text" value="{{$all_penjualan[0]['alamat_toko_pelanggan']}}" id="alamat_toko" class="nota-edited" readonly></td>
                                </tr>
                            </table>
                        </table>
                    </div>
                    <div class="col-lg-4 float-left" >
                        <table>
                            <table>
                                <tr>
                                    <td> Metode Bayar </td>
                                    <td class="pl-2 pr-2"> : </td>
                                    <td> <input type="text" value="{{$all_penjualan[0]['metode_pembayaran']}}" id="metode_pembayaran" class="nota-edited" readonly></td>
                                </tr>
                                <tr>
                                    <td> Status  </td>
                                    <td class="pl-2 pr-2"> : </td>
                                    <td> <input type="text" value="Retur" id="status" class="nota-edited" readonly></td>
                                </tr>
                            </table>
                        </table>
                    </div>
                </div>
                <div class="container pt-3">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <colgroup>
                                    <col style="width: 15%">
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th> Kode Barang </th>
                                        <th> Nama Barang </th>
                                        <th> Jumlah </th>
                                        <th> Satuan </th>
                                        <th> Harga </th>
                                        <th> Total </th>
                                        <th> Jenis Retur </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($all_retur_penjualan) == 0)
                                        <tr>
                                            <th colspan="7"> TIDAK ADA DATA</th>
                                        </tr>
                                    @else
                                        <?php $total = 0;$jumlah_barang=0;?>
                                        @foreach ($all_retur_penjualan as $a_r_p)
                                            <tr>
                                                <td> <input type="text" value="{{$a_r_p->id_barang}}" id="id_barang" class="nota-edited" readonly> </td>
                                                <td> {{$a_r_p->nama_barang}} </td>
                                                <td> {{$a_r_p->jumlah_barang}} </td>
                                                <td> Pcs </td>
                                                <td> {{number_format($a_r_p->nominal_retur,0,',','.')}} </td>
                                                <td> {{number_format($a_r_p->nominal_retur*$a_r_p->jumlah_barang,0,',','.')}} </td>
                                                <td>
                                                    <select name="jenis_retur" id="jenis_retur" onchange="pilih_jenis_retur(this)" id_barang="{{$a_r_p->id_barang}}" class="form-control">
                                                        <option value="-"> --- PILIH --- </option>
                                                        <option value="Retur Barang" {{$a_r_p->jenis_retur == "Retur Barang" ? "selected" : ""}}> Retur Barang </option>
                                                        <!-- <option value="Kembali Uang" {{$a_r_p->jenis_retur == "Kembali Uang" ? "selected" : ""}}> Kembali Uang </option> -->
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php 
                                            $total+= $a_r_p->nominal_retur*$a_r_p->jumlah_barang;
                                            $jumlah_barang += $a_r_p->jumlah_barang;
                                        ?>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="container pt-2">
                    <div class="col-lg-10 float-left">
                        <table>
                            <tr>
                                <th> Sub Total </th>
                                <th class="pl-3"> {{number_format($total,0,',','.')}} </th>
                            </tr>
                            <tr>
                                <th> Biaya Kirim </th>
                                <th class="pl-3"> <input type="text" id="biaya_kirim" value="0" class="nota-edited" readonly> </th>
                            </tr>
                            <tr>
                                <th> Total </th>
                                <th class="pl-3"> {{number_format($total,0,',','.')}} </th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-2 float-left">
                        <button class="btn btn-danger" id="btn_retur"> <i class="fas fa-exchange-alt"></i> Buat Retur </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    var data_jenis_retur = [];
    $(document).ready(function(){
        $('#btn_retur').click(function(){
            const id_penjualan = $('#id_transaksi').val();
            const jumlah_produk_retur = '{{$jumlah_barang}}';
            const tanggal_retur = $('#tanggal_retur').val();
            const jenis_retur = $('#jenis_retur').val();
            const id_toko_pelanggan = $('#id_toko_pelanggan').val();
           
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                html : '<font> Jumlah Stock akan bertambah   !!</font> <br> Jika Menyetujui retur',
                showConfirmButton : true,
                showCancelButton : true,
                confirmButtonColor : '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText : 'Ya, Setujui Retur !',
                cancelButtonText : 'Batalkan Retur',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : '<?= url('/adm/nota-penjualan/simpan_retur') ?>',
                        method : 'POST',
                        data : {
                            id_penjualan : id_penjualan,
                            jumlah_produk_retur : jumlah_produk_retur,
                            tanggal_retur : tanggal_retur,
                            id_toko_pelanggan : id_toko_pelanggan,
                            jenis_retur : data_jenis_retur,
                            status : 'Setuju'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:function(data){
                            console.log(data);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Nota Retur penjualan telah dibuat',
                                timer : 1500
                            });
                            location.href="<?= asset('/adm/nota-penjualan/') ?>";
                        }
                    });
                }else{
                    $.ajax({
                        url : '<?= url('/adm/nota-penjualan/simpan_retur') ?>',
                        method : 'POST',
                        data : {
                            id_penjualan : id_penjualan,
                            jumlah_produk_retur : jumlah_produk_retur,
                            tanggal_retur : tanggal_retur,
                            id_toko_pelanggan : id_toko_pelanggan,
                            jenis_retur : data_jenis_retur,
                            status : 'Batal'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:function(data){
                            console.log(data);
                            Swal.fire({
                                icon: 'danger',
                                title: 'Peringatan',
                                text: 'Nota Retur Pembelian dibatalkan',
                                timer : 2500
                            })
                            location.href="<?= asset('/adm/nota-penjualan') ?>";
                        }
                    });
                }
            })
        })
    });
    
    function pilih_jenis_retur(el){
        var id_barang = $(el).attr("id_barang");
        data_jenis_retur.push({id_barang : id_barang,jenis_retur : el.value});
        console.log(data_jenis_retur);
    }
</script>
@endpush