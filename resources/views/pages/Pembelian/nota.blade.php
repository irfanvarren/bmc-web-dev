@extends('layouts.app',['title' => 'BMC | Nota Pembelian'])
@section('content')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="container">
                <div class="col-lg-6 float-left">
                    <i class="fas fa-clipboard h3"></i>
                    <font class="pl-3 mb-3 h3"> Nota Pembelian </font> 
                </div>
                <div class="col-lg-6 float-left">
                    <div class="mb-3 text-right">
                        Tanggal : {{date("d/m/Y")}}
                    </div>
                </div>
            </div>
            <div class="col-lg-12"> <hr></div>
            <div class="container">   
                <div class="row form-group">
                    <div class="col-xl-4">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang">  Order</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="date" class="form-control" id="tanggal_order" name="tanggal_order" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang"> Terima </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="date" class="form-control" id="tanggal_terima" name="tanggal_terima">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang"> Toko </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="nama_toko" name="nama_toko" placeholder="Nama Toko">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 pt-2">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang"> Status Pembelian </label>
                            </div>
                            <div class="col-xl-8">
                                <select name="status" id="status" class="form-control">
                                    <option value="-"> --- PILIH --- </option>
                                    <option value="Retur"> Retur </option>
                                    <option value="Diterima"> Diterima </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 pt-2 text-right">
                        <div class="row ">
                            <div class="col-xl-12">
                                <acronym title="Reset">
                                    <button class="btn btn-secondary" id="reset"> <i class="fas fa-power-off"></i> </button>
                                </acronym>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-bordered" style="text-align: center">
                        <colgroup>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col style="width:16%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th> ID Pembelian </th>
                                <th> Tanggal Order </th>
                                <th> Tanggal Terima </th>
                                <th> Nama Toko  </th>
                                <th> Status </th>
                                <th> Total Harga </th>
                                <th> Total Transaksi </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
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

    $('#status').click(function(){
        filter_nota();
    });
    $('#tanggal_order').change(function(){
        filter_nota();
    });
    $('#tanggal_terima').change(function(){
        filter_nota();
    });
    $('#nama_toko').keyup(function(){
        filter_nota();
    });

    $(document).ready(function(){
        filter_nota();
    });

    $('#reset').click(function(){
        $.ajax({
            url : '<?= asset('/adm/nota-pembelian/filter') ?>',
            method : 'POST',
            data : {nama_toko : "",tanggal_order : "", tanggal_terima:"",status:"-"},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             success:function(data){
                $('tbody').html(data);
                $('#nama_toko').val("");
                $('#tanggal_order').val("");
                $('#status').val("-");
                $('#tanggal_terima').val("");
            }
        });
    });

    function filter_nota(){
        const nama_toko = $('#nama_toko').val();
        const tanggal_order = $('#tanggal_order').val();
        const status = $('#status').val();
        const tanggal_terima = $('#tanggal_terima').val();
        $.ajax({
            url : '<?= asset('/adm/nota-pembelian/filter') ?>',
            method : 'POST',
            data : {nama_toko : nama_toko,tanggal_order : tanggal_order, tanggal_terima:tanggal_terima,status:status},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             success:function(data){
                $('tbody').html(data);
            }
        });
    }
    
    function hapus(id_pembelian){
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
                location.href="<?= url('/adm/nota-pembelian/') ?>/"+id_pembelian+"/delete";
            }
        })
    }
</script>
@endpush
