@extends('layouts.app',['title' => 'BMC | Penjualan'])
@section('content')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <div class="col-lg-6 float-left">
                        <i class="fas fa-coins h3"></i>
                        <font class="pl-3 mb-3 h3"> Transaksi Penjualan </font> 
                    </div>
                    <div class="col-lg-6 float-left">
                        <div class="mb-3 text-right">
                            Tanggal : {{date("d/m/Y")}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-12"> <hr></div>
                <div class="container">
                    <form action="/adm/penjualan/simpan_nota" method="POST">
                        @csrf
                        <div class="row form-group">
                            <div class="col-xl-6">
                                <div class="row ">
                                    <div class="col-xl-4">
                                        <label for="id_barang"> ID Penjualan </label>
                                    </div>
                                    <div class="col-xl-8">
                                        <input type="text" readonly class="form-control" id="id_penjualan" value="{{$id_penjualan}}" name="id_penjualan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <label for="id_barang"> Nama Toko </label>
                                    </div>
                                    <div class="col-xl-8">
                                        <select name="nama_toko" autofocus required class="form-control" id="nama_toko">
                                            <option value=""> Pilih Toko </option>
                                            @foreach($all_pelanggan as $ap)
                                            <option value="<?= $ap->id_toko_pelanggan ?>" >{{$ap->nama_toko_pelanggan}}</option>
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
                                        <label for="id_barang">Tanggal Order </label>
                                    </div>
                                    <div class="col-xl-8">
                                        <input type="date" class="form-control" id="tanggal_order" name="tanggal_order" required placeholder="Nama Toko">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="row ">
                                    <div class="col-xl-4">
                                        <label for="id_barang"> Alamat Toko  </label>
                                    </div>
                                    <div class="col-xl-8">
                                        <input type="text" readonly class="form-control" id="alamat_toko" required name="alamat_toko" placeholder="Alamat Toko">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xl-6">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <label for="id_barang"> Tanggal Kirim </label>
                                    </div>
                                    <div class="col-xl-8">
                                        <input type="date" value="{{date('Y-m-d')}}" class="form-control" id="tanggal_kirim" required name="tanggal_kirim" onchange="pilih_tanggal_kirim(this)" placeholder="Alamat Toko">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="row ">
                                    <div class="col-xl-4">
                                        <label for="id_barang"> Metode Pembayaran </label>
                                    </div>
                                    <div class="col-xl-8">
                                        <select name="metode_pembayaran" class="form-control" id="metode_pembayaran" required>
                                            <option value="-"> Pilih Metode </option>
                                            <option value="Cash"> Cash </option>
                                            <option value="Kredit"> Kredit </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xl-6">
                                <div class="row ">
                                    <div class="col-xl-4">
                                        <label for="id_barang"> Diskon </label>
                                    </div>
                                    <div class="col-xl-8">
                                        <input type="number" class="form-control"  id="diskon" name="diskon" min="0" max="100" placeholder="0-100%">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="row ">
                                    <div class="col-xl-4">
                                        <label for="id_barang"> Jatuh Tempo </label>
                                    </div>
                                    <div class="col-xl-8">
                                        <input type="date" name="jatuh_tempo" id="jatuh_tempo" class="form-control" value="{{date('Y-m-d', strtotime('+2 Week'))}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xl-6">
                                <div class="row ">
                                    <div class="col-xl-4">
                                        <label for="id_barang"> Penanggung Jawab </label>
                                    </div>
                                    <div class="col-xl-8">
                                        <input type="text" readonly class="form-control" id="penanggung_jawab" name="penanggung_jawab" placeholder="Penanggung Jawab">
                                        <a href="javascript:void(0)" id="ganti_nama" style="font-size: 10px;padding-left:10px"> Ganti Nama Penanggung Jawab </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="row ">
                                    <div class="col-xl-4">
                                        <label for="id_barang"> No HP </label>
                                    </div>
                                    <div class="col-xl-8">
                                        <input type="text" class="form-control" name="no_hp" id="no_hp" readonly placeholder="No Hp">
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
                                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" style="resize: none"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xl-12">
                                <div class="table-responsive" id="data-output">
                                    <div class="py-3">
                                        <div class="p-3 pt-4 position-relative"  style="border:1px solid black;">
                                            <span style="position:absolute;top:-12.5px ;left:15px;height:25px;background:white;padding:0 8px;">Keranjang Jual</span>
                                            <div class="row mb-3 detail-input" id="detail-input">
                                                <div class="col-md-2">
                                                     <input type="text" class="form-control mx-3" readonly name="dtlid_barang" id="dtlid_barang" placeholder="ID Barang">
                                                </div>
                                                <div class="col-md-2 ">
                                                      <select class="js-example-basic-single mx-3" id="dtlnama_barang" name="dtlnama_barang" >
                                                    <option value="-"> --- Pilih --- </option>
                                                    @foreach($all_stock as $as)
                                                    <option value="{{$as->id_barang}}" data-name="{{$as->nama_barang}}"> {{$as->nama_barang}} </option>
                                                    @endforeach
                                                </select>
                                                </div>
                                                <div class="col-md-2">
                                                      <input type="text" class="form-control mx-3" name="dtlharga_barang" id="dtlharga_barang" placeholder="Harga Barang">
                                                </div>
                                                <div class="col-md-2">
                                                       <input type="text" class="form-control mx-3" value="0" min="0" max="100" name="dtldiskon" id="dtldiskon" placeholder="Diskon">
                                                </div>
                                                <div class="col-md-2">
                                                     <input type="text" class="form-control mx-3" min="1" name="dtljumlah" id="dtljumlah" placeholder="Jumlah">
                                                </div>
                                                <div class="col-md-2">
                                                      <button class="btn btn-primary w-100 ml-2" id="dtltambah" value="add" type="button"> <i class="fa fa-plus"></i>  Tambah</button>
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
                        <div class="row form-group pt-3">
                            <div class="col-xl-12">
                                <div class="row" style="margin-top: -10px">
                                    <div class="col-xl-2">
                                        <button class="btn btn-primary" type="submit"> <i class="fas fa-save"></i> Simpan Nota </button>
                                    </div>
                                </div>
                            </div>
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
@if(session()->has('status'))
    Swal.fire({
      icon: '{{session()->has("icon") ? session("icon") : "success"}}',
      title: '{{session("judul_alert")}}\n{{session("status")}}',
      showConfirmButton: false,
      timer: 1500
  })
@endif
    $('#tanggal_kirim').change(function(){
        const tanggal_order = $('#tanggal_order').val();
        const tanggal_kirim = $('#tanggal_kirim').val();
        const tanggal = new Date();
        const current_date = formatDate(tanggal);
        if(tanggal_order > tanggal_kirim){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Tanggal kirim tidak boleh dibawah tanggal order',
            })
            $('#tanggal_kirim').val(current_date);
            tanggal.setDate(tanggal.getDate()  + 14);
            $('#jatuh_tempo').val(tanggal.toISOString().split('T')[0]);
        }else if(tanggal_kirim < current_date){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Perhatikan tanggal hari ini',
            })
            $('#tanggal_kirim').val(current_date);
            tanggal.setDate(tanggal.getDate()  + 14);
            $('#jatuh_tempo').val(tanggal.toISOString().split('T')[0]);
        }
    });
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
    $('#tanggal_order').change(function(){
        const tanggal_order = $('#tanggal_order').val();
        const tanggal_kirim = $('#tanggal_kirim').val();
        if(tanggal_order > tanggal_kirim){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Tanggal order tidak boleh melebihi tanggal kirim',
            })
            $('#tanggal_order').val("");
        }
    });
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
    $(document).ready(function(){
        const id_penjualan = $('#id_penjualan').val();
        $.ajax({
            url : '<?= asset('/adm/penjualan/items') ?>',
            data : {
                id_penjualan : id_penjualan,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            // dataType : 'JSON',
            success:function(data){
                var data_arr = data.split('###');
                var output = data_arr[0];
                var subtotal = data_arr[1];
                $('#subtotal').val(subtotal);
                hitung_total();
                $('#output-detail').html(output);
                $('#detail-input input').val("");
                $('#detail-input #dtldiskon').val("0");
            }
        });
        var click = 0;
        $('#ganti_nama').click(function(){
            click++;
            if(click % 2){
                $('#penanggung_jawab').attr('readonly',false);
            }else{
                $('#penanggung_jawab').attr('readonly',true);
            }
        })
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $('#tanggal_kirim').change(function(){
            const tanggal_kirim = $('#tanggal_kirim').val();
            const tambah = parseInt(tanggal_kirim) + 14;
        });
        $('#dtlnama_barang').change(function(){
            const dtlid_barang = $('#dtlnama_barang').val();
            $.ajax({
                url : '<?= asset('/adm/penjualan/detail_barang') ?>',
                data : {id_barang : dtlid_barang},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method : 'POST',
                dataType : 'JSON',
                success:function(data){
                    $('#dtlid_barang').val(data[0].id_barang);
                    const harga_min = data[0].harga_minimal;
                    const harga_max = data[0].harga_maximal;
                    const hasil = (harga_min + harga_max)/2;
                    $('#dtlharga_barang').val(hasil);
                }
            });
        });
        $('#nama_toko').change(function(){
            const id_toko = $('#nama_toko').val();
            $.ajax({
                url:'<?= asset('/adm/penjualan/cek_id') ?>',
                data : {
                    id_toko : id_toko
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method : 'POST',
                dataType : 'JSON',
                success:function(data){
                    $('#penanggung_jawab').val(data[0].penanggung_jawab);
                    $('#alamat_toko').val(data[0].alamat_toko_pelanggan);
                    $('#no_hp').val(data[0].no_telp);
                }
            });
        });
        $('#dtltambah').click(function(){
            const id_penjualan = $('#id_penjualan').val();
            const id_barang = $('#dtlid_barang').val();
            const nama_barang = $('#dtlnama_barang option:checked').data('name');
            const harga_barang = $('#dtlharga_barang').val();
            const diskon = $('#dtldiskon').val();
            const jumlah = $('#dtljumlah').val();
            var cmd = $('#dtltambah').attr("value");
            if(diskon < 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text : 'Nilai diskon salah',
                    showConfirmButton: false,
                    timer: 1500
                })
            }else if(diskon > 100){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text : 'Nilai diskon salah',
                    showConfirmButton: false,
                    timer: 1500
                })
            }else if(id_barang == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text : 'Data tidak lengkap',
                    showConfirmButton: false,
                    timer: 1500
                })
            }else if(jumlah == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text : 'Jumlah item kosong',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
            $.ajax({
                url : '<?= asset('/adm/penjualan/items') ?>',
                data : {
                    id_penjualan : id_penjualan,
                    id_barang : id_barang,
                    nama_barang : nama_barang,
                    harga_barang : harga_barang,
                    diskon : diskon,
                    jumlah : jumlah,
                    cmd : cmd
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method : 'POST',
                // dataType : 'JSON',
                success:function(data){
                    var title = "Data disimpan";
                    if(cmd == "edit"){
                        title = "Data diedit";
                    }
                    var data_arr = data.split('###');
                    var output = data_arr[0];
                    var output2 = data_arr[1];
                    if(output != "Error"){
                        Swal.fire({
                        icon: 'success',
                        title: title,
                        showConfirmButton: false,
                        timer: 1500
                    });
                        $('#subtotal').val(output2);
                        hitung_total();
                        $('#output-detail').html(output);
                        $('#detail-input input').val("");
                        $('#detail-input #dtldiskon').val("0");
                        $('#dtltambah').html(' <i class="fa fa-plus"></i>  Tambah ');
                        $('#dtltambah').attr("value","add");
                    }else{
                        alert(output2);
                    }
                }
            });
        });
    });
    function edit_barang(id_barang,nama_barang,harga_barang,diskon,jumlah_barang){
        $('#dtlid_barang').val(id_barang);
        $('#dtlnama_barang').val(id_barang);
        $('#dtlnama_barang').select2().trigger('change');
        $('#dtlharga_barang').val(harga_barang);
        $('#dtldiskon').val(diskon);
        $('#dtljumlah').val(jumlah_barang);
        $('#dtltambah').html('<i class="fa fa-edit"></i>  Edit Barang');
        $('#dtltambah').attr("value","edit");
    }
    function hapus_barang(id_barang){
        const id_penjualan = $('#id_penjualan').val();
        $.ajax({
            url : '<?= asset('/adm/penjualan/items') ?>',
            data : {
                id_penjualan : id_penjualan,
                id_barang : id_barang,
                cmd : "delete"
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            // dataType : 'JSON',
            success:function(data){
                var data_arr = data.split('###');
                var output = data_arr[0];
                var output2 = data_arr[1];
                if(output!= "Error"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Data dihapus',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#subtotal').val(output2);
                    hitung_total();
                    $('#output-detail').html(output);
                    $('#detail-input input').val("");
                    $('#detail-input #dtldiskon').val("0");
                    $('#dtltambah').html(' <i class="fa fa-plus"></i>  Tambah ');
                    $('#dtltambah').attr("value","add");
                }else{
                    alert(output2);
                }
            }
        });
    }
    function pilih_tanggal_kirim(e){
        var tanggal_jatuh_tempo = new Date(e.value);
        tanggal_jatuh_tempo.setDate(tanggal_jatuh_tempo.getDate()  + 14);
        $('#jatuh_tempo').val(tanggal_jatuh_tempo.toISOString().split('T')[0]);
    }
    function hitung_total(){
        var subtotal = document.getElementById('subtotal').value;
        subtotal = subtotal.replace(".","");
        $('#total').val(formatRupiah(subtotal));
    }
</script>
@endpush