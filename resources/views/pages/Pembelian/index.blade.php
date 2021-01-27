@extends('layouts.app',['title' => 'BMC | Transaksi Pembelian'])

@section('content')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="container">
                <div class="col-lg-6 float-left">
                    <i class="fas fa-shopping-cart h3"></i>
                    <font class="pl-3 mb-3 h3"> Transaksi Pembelian </font> 
                </div>
                <div class="col-lg-6 float-left">
                    <div class="mb-3 text-right">
                        Tanggal : {{date("d/m/Y")}}
                    </div>
                </div>
            </div>
            <div class="col-lg-12"> <hr></div>
            <div class="container">   
            <form action="<?= url('/adm/pembelian/simpan_nota') ?>" method="POST">
                @csrf
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang">ID Pembelian</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" id="id_pembelian" class="form-control" name="id_pembelian" value="{{$id_pembelian}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 ">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang"> Tanggal Order </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="date" required class="form-control" id="tanggal_order" name="tanggal_order" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang"> Nama Toko</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" required class="form-control" id="nama_toko" name="nama_toko" placeholder="Nama Toko">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang"> Alamat Toko</label>
                            </div>
                            <div class="col-xl-8">
                                <select name="alamat_toko" class="form-control" id="alamat_toko" required>
                                    <option value="-"> Pilih Alamat </option>
                                    <option value="Banda Aceh"> Aceh </option>
                                    <option value="Medan"> Sumatera Utara </option>
                                    <option value="Padang"> Sumatera Barat </option>
                                    <option value="Pekanbaru"> Riau </option>
                                    <option value="Jambi"> Jambi </option>
                                    <option value="Palembang"> Sumatera Selatan </option>
                                    <option value="Pangkal Pinang"> Kepulauan Bangka Belitung </option>
                                    <option value="Bengkulu"> Bengkulu </option>
                                    <option value="Lampung"> Bandar Lampung </option>
                                    <option value="Jakarta"> DKI Jakarta </option>
                                    <option value="Serang"> Banten </option>
                                    <option value="Bandung"> Jawa Barat </option>
                                    <option value="Semarang"> Jawa Tengah </option>
                                    <option value="Yogyakarta"> DI Yogyakarta </option>
                                    <option value="Surabaya"> Jawa Timur </option>
                                    <option value="Bali"> Denpasar </option>
                                    <option value="Mataram"> Nusa Tenggara Barat </option>
                                    <option value="Kupang"> Nusa Tenggara Timur </option>
                                    <option value="Pontianak"> Kalimantan Barat </option>
                                    <option value="Palangkaraya"> Kalimantan Tengah </option>
                                    <option value="Banjarmasin"> Kalimantan Selatan </option>
                                    <option value="Samarinda"> Kalimantan Timur </option>
                                    <option value="Tanjung Selor"> Kalimantan Utara </option>
                                    <option value="Manado"> Sulawesi Utara </option>
                                    <option value="Gorontalo"> Gorontalo </option>
                                    <option value="Palu"> Sulawesi Tengah </option>
                                    <option value="Mamuju"> Sulawesi Barat </option>
                                    <option value="Makasar"> Sulawesi Selatan </option>
                                    <option value="Kendari"> Sulawesi Tenggara </option>
                                    <option value="Ambon"> Maluku </option>
                                    <option value="Sofifi"> Maluku Utara </option>
                                    <option value="Manokwari"> Papua Barat </option>
                                    <option value="Jayapura"> Papua </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang"> Nama Penerima </label>
                            </div>
                            <div class="col-xl-8">
                                <select name="nama_penerima" required class="form-control" id="nama_penerima">
                                    <option value="-"> Pilih Penerima </option>
                                    @foreach($all_penerima as $a_pen)
                                        <option value="{{$a_pen->id_penerima}}"> {{$a_pen->nama_penerima}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang">Pilih Ekspedisi</label>
                            </div>
                            <div class="col-xl-8">
                                <select name="id_ekspedisi" required class="form-control" id="id_ekspedisi">
                                    <option value="-"> Pilih Eksepdisi </option>
                                    @foreach($all_ekspedisi as $a_eks)
                                       <option value="{{$a_eks->id_ekspedisi}}"> {{$a_eks->nama_ekspedisi}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang"> Ongkir </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="number"  name="ongkir" id="ongkir" placeholder="Rp.10.000" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang"> Metode Pembayaran </label>
                            </div>
                            <div class="col-xl-8">
                                <select name="metode_pembayaran" required class="form-control" id="metode_pembayaran">
                                    <option value="-"> Pilih Pembayaran </option>
                                    <option value="Shopee Pay"> Shoppe Pay </option>
                                    <option value="Shopee Pay Later"> Shopee Pay Later </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row" style="margin-top: -10px">
                            <div class="col-xl-2">
                                <label for="id_barang"> Keterangan  </label>
                            </div>
                            <div class="col-xl-10">
                                <textarea class="form-control" id="keterangan" name="keterangan"  placeholder="Keterangan" style="resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-2">
                                <a href="javascript:void(0)" id="potongan"> Potongan Harga </a>    
                            </div>   
                            <div class="col-xl-4">
                                <input type="text" id="potongan_harga" style="display: none" name="potongan_harga" class="form-control" placeholder="Potongan Harga">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="table-responsive" id="data-output">
                            <div class="py-3">
                                <div class="p-3 pt-4 position-relative"  style="border:1px solid black;">
                                    <span style="position:absolute;top:-12.5px ;left:15px;height:25px;background:white;padding:0 8px;">Keranjang Beli</span>
                                    <div class="mb-3 detail-input">
                                        <div class="col-lg-2 float-left">
                                            <label for="ID Barang"> ID Barang</label>
                                            <input type="text" class="form-control" readonly name="dtlid_barang" id="dtlid_barang" placeholder="ID Barang">
                                            <a href="javascript:void(0)" id="item_baru" > Item Baru </a>
                                        </div>
                                        <div class="col-lg-2 float-left">
                                            <label for="Nama Barang"> Nama Barang</label>
                                            <select class="js-example-basic-single" id="dtlnama_barang" style="width:100%" name="dtlnama_barang">
                                                <option value="-"> --- Pilih --- </option>
                                                @foreach($all_stock as $as)
                                                    <option value="{{$as->id_barang}}" data-name="{{$as->nama_barang}}"> {{$as->nama_barang}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 float-left">
                                            <label for="Harga Barang"> Harga Barang </label>
                                            <input type="text" class="form-control" name="harga_barang" id="harga_barang"  placeholder="Harga Barang">
                                        </div>
                                        <div class="col-lg-2 float-left">
                                            <label for="Kondisi"> Kondisi </label>
                                            <select name="dtlkondisi" id="dtlkondisi" class="form-control">
                                                <option value="-"> --- PILIH --- </option>
                                                <option value="Sangat Bagus"> Sangat Bagus </option>
                                                <option value="Bagus"> Bagus </option>
                                                <option value="Cukup"> Cukup </option>
                                                <option value="Tidak Bagus"> Tidak Bagus </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 float-left">
                                            <label for="Jenis Barang"> Jenis Barang </label>
                                            <select name="dtljenis_barang" id="dtljenis_barang" class="form-control">
                                                <option value="-"> --- PILIH --- </option>
                                                @foreach($all_jenis as $aj)
                                                    <option value="{{$aj->jenis_barang}}"> {{$aj->jenis_barang}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 float-right ">
                                            <label for="Jumlah"> Jumlah </label>
                                            <input type="text" class="form-control" name="dtljumlah" id="dtljumlah" placeholder="Jumlah">
                                        </div>
                                        <div class="col-lg-2 float-right pt-2">
                                            <input type="text" class="form-control" name="dtlsatuan" id="dtlsatuan" placeholder="Satuan" value="Pcs" readonly>
                                        </div>
                                        <div class="col-lg-4 float-right pt-2 text-right">
                                            <button class="btn btn-primary w-100 ml-2" value="add" type="button"  id="tambah_barang"> <i class="fa fa-plus"></i>  Tambah</button>
                                        </div>
                                    </div>
                                    <div style="width:100%;overflow:auto" id="output-detail">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="subtotal">Subtotal</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" name="subtotal" id="subtotal" value="0" onchange="hitung_total()" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="subtotal">Total</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" readonly class="form-control" name="total" id="total" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12 text-right">
                        <button class="btn btn-primary" type="submit"> <i class="fas fa-save"></i> Simpan Transaksi</button>
                    </div>
                </div>
            </form>
            </div>
            </div>
        </div>
    </div>
</div>
@include('pages.Pembelian.modal');
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
    $(document).ready(function(){
        $.ajax({
            url : '<?= asset('/adm/pembelian/tambah_barang') ?>',
            data : {
                id_pembelian : $('#id_pembelian').val(),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            //dataType : 'JSON',
            success:function(data){
                var data_arr = data.split('###');
                var output = data_arr[0];
                var subtotal = data_arr[1];
                $('#subtotal').val(subtotal);
                 hitung_total();
                $('#output-detail').html(output);
            }
        });
        var click = 0;
        $('#potongan').click(function(){
            click++;
            if(click %2){
                $('#potongan_harga').css({"display":"block"});
            }else{
                $('#potongan_harga').css({"display":"none"});
            }
        });
        $('#tanggal_order').change(function(){
            const tanggal_order = $('#tanggal_order').val();
            const tanggal = new Date();
            const current_date = formatDate(tanggal);
            if(tanggal_order > current_date){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Tanggal order tidak boleh melebihi tanggal hari ini',
                })
                $('#tanggal_order').val("");
            }
        });
        $(document).ready(function() {
            $('.js-example-basic-single').select2()
        });
        $('#dtlnama_barang').change(function(){
            const dtlid_barang = $('#dtlnama_barang').val();
            $.ajax({
                url : '<?= asset('/adm/pembelian/dtlid_barang') ?>',
                data : {id_barang : dtlid_barang},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method : 'POST',
                dataType : 'JSON',
                success:function(data){
                    $('#dtlid_barang').val(data[0].id_barang);
                    $('#harga_barang').focus();
                }
            });
        });
        $('#tambah_barang').click(function(){
            const nama_barang = $('#dtlnama_barang option:checked').data('name');
            const cmd = $('#tambah_barang').attr("value");
            const jumlah = $('#dtljumlah').val();
            if(jumlah == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text : 'Jumlah item kosong',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
            $.ajax({
                url : '<?= asset('/adm/pembelian/tambah_barang') ?>',
                data : {
                    id_pembelian : $('#id_pembelian').val(),
                    id_barang : $('#dtlid_barang').val(),
                    nama_barang : nama_barang,
                    jumlah_barang : $('#dtljumlah').val(),
                    harga_barang : $('#harga_barang').val(),
                    kondisi : $('#dtlkondisi').val(),
                    satuan : $('#dtlsatuan').val(),
                    jenis_barang : $('#dtljenis_barang').val(),
                    cmd : cmd
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method : 'POST',
                success:function(data){
                    if(cmd == "edit"){
                        Swal.fire({
                            icon: 'success',
                            title: "Data diedit",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }else if(cmd =="add"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Data ditambahkan',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    var data_arr = data.split('###');
                    var output = data_arr[0];
                    var subtotal = data_arr[1];
                    $('#subtotal').val(subtotal);
                    hitung_total();
                    $('#output-detail').html(output);
                    $('#dtlid_barang').val("");
                    $('#dtlnama_barang').val("");
                    $('#dtljumlah').val("");
                    $('#harga_barang').val("");
                    $('#dtlkondisi').val("");
                    $('#dtlsatuan').val("Pcs");
                    $('#dtljenis_barang').val("");
                    $('#tambah_barang').html(' <i class="fa fa-plus"></i>  Tambah ');
                    $('#tambah_barang').attr("value","add");
                }
            });
        });
        $('#item_baru').click(function(){
            $('#stockModal').modal('show');
        });
        $('#add_items').click(function(){
            $.ajax({
                url : '<?= asset('/adm/pembelian/add_items') ?>',
                data : {
                    id_barang : $('#id_barang').val(),
                    nama_barang : $('#nama_barang').val(),
                    stock_barang : $('#stock_barang').val(),
                    jenis_barang : $('#jenis_barang').val(),
                    harga_minimal : $('#harga_minimal').val(),
                    harga_maximal : $('#harga_maximal').val(),
                    satuan : $('#satuan').val() 
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method : 'POST',
                success:function(data){
                    $('#stockModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil ditambahkan',
                    })
                    $('#id_barang').val("");
                    $('#nama_barang').val("");
                    $('#stock_barang').val("");
                    $('#jenis_barang').val("");
                    $('#harga_minimal').val("");
                    $('#harga_maximal').val("");
                    $('#satuan').val("Pcs") ;
                }
            });
        });
    }); 
    function edit_barang(id_barang,nama_barang,jumlah_barang,satuan,jenis_barang,kondisi,harga_barang){
        $('#dtlid_barang').val(id_barang);
        $('#dtljumlah').val(jumlah_barang);
        $('#harga_barang').val(harga_barang);
        $('#dtlkondisi').val(kondisi);
        $('#dtlsatuan').val(satuan);
        $('#dtljenis_barang').val(jenis_barang);
        $('#dtlnama_barang').val(id_barang);
        $('#dtlnama_barang').select2().trigger('change');
        $('#tambah_barang').html('<i class="fa fa-edit"></i>  Edit Barang');
        $('#tambah_barang').attr("value","edit");
    }
    function hapus_barang(id_barang){
        const id_pembelian = $('#id_pembelian').val();
        $.ajax({
            url : '<?= asset('/adm/pembelian/tambah_barang') ?>',
            data : {
                id_pembelian : id_pembelian,
                id_barang : id_barang,
                cmd : "delete"
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil dihapus',
                    showConfirmButton: false,
                    timer: 1500
                });
                var data_arr = data.split('###');
                var output = data_arr[0];
                var subtotal = data_arr[1];
              
                $('#subtotal').val(subtotal);
                  hitung_total();
                $('#output-detail').html(output);
                $('#tambah_barang').html(' <i class="fa fa-plus"></i>  Tambah ');
                $('#tambah_barang').attr("value","add");
            }
        });
    }
    $('#ongkir').on('change',function(){
        hitung_total();
    });
    $('#potongan_harga').on('change',function(){
        hitung_total();
    });
    function hitung_total(){
        var subtotal = document.getElementById('subtotal').value;
        subtotal = parseFloat(subtotal.split(".").join(""));
        // subtotal = parseFloat(subtotal);
        var potongan_harga = document.getElementById('potongan_harga').value;
        if(potongan_harga != ""){
            potongan_harga = parseInt(potongan_harga);
        }else{
            potongan_harga = 0;   
        }
        var ongkir = document.getElementById('ongkir').value;
        if(ongkir != ""){
            ongkir = parseInt(ongkir);
        }else{
            ongkir = 0;    
        }
        var total = (subtotal + ongkir) - potongan_harga;
        $('#total').val(formatRupiah(total.toString()));
    }
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
      function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
@endpush