@extends('layouts.app')
@section('content')
@include('pages.Toko.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <div class="col-lg-6 float-left">
                        <i class="fas fa-store-alt h3"></i>
                        <font class="pl-3 mb-3 h3"> Toko Pelanggan </font> 
                    </div>
                    <div class="col-lg-6 float-left">
                        <div class="mb-3 text-right">
                            Tanggal : {{date("d/m/Y")}}
                        </div>
                    </div>
                </div>
                <div class="container"> <hr>
                    <div class="text-left">
                        <a class="btn btn-primary" href="javascript:void(0)" onclick="tambah()"> <i class="fas fa-plus-circle"></i> Add </a>
                    </div>
                </div>
                <div class="container">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <tr>
                                <th> ID Toko </th>
                                <th> Nama Toko </th>
                                <th> Penanggung Jawab </th>
                                <th> Alamat Toko </th>
                                <th> No Telp </th>
                                <th> Pembelian Ke </th>
                                <th> Action </th>
                            </tr>
                            @foreach($all_pelanggan as $ap)
                                <tr>
                                    <td> {{$ap->id_toko_pelanggan}} </td>
                                    <td> <?= $ap->nama_toko_pelanggan ?> </td>
                                    <td> {{$ap->penanggung_jawab}} </td>
                                    <td> {{$ap->alamat_toko_pelanggan}} </td>
                                    <td> {{$ap->no_telp}} </td>
                                    <td> {{$ap->pembelian_ke}} </td>
                                    <td>
                                        <form action="{{url('adm/toko/hapus_data')}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id_toko_pelanggan" value="{{$ap->id_toko_pelanggan}}">
                                            <a href="javascript:void(0)" onclick="edit('<?= $ap->id_toko_pelanggan ?>')" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </a> 
                                            <button onclick="hapus(event,this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
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
  icon: 'success',
  title: '{{session("judul_alert")}}\n{{session("status")}}',
  showConfirmButton: false,
  timer: 1500
})
@endif

    function hapus(e,btn){
         e.preventDefault();
        $(document).ready(function(){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger ml-3',
                    cancelButton: 'btn btn-success'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Anda yakin ?',
                text: "Data tidak dapat dipulihkan kembali",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Jangan, Batal!',
                reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                 $(btn).parent().submit();
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Batal',
                'Data batal terhapus',
                'error'
                )
            }
            })
        });
    }
    function tambah(){
        $(document).ready(function(){
            $('#tokoModal').modal('show');
            $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Toko');
            $('.modal-body form').attr('action','<?= '/adm/toko/simpan_data' ?>');
            $('.modal-footer button[type=submit]').html('<i class="fas fa-save"></i> Simpan Data');
            $.ajax({
                url : '<?= asset('/adm/toko/ambil_id') ?>',
                method : 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'JSON',
                success:function(data){
                    $('#id_toko_pelanggan').val(data);
                    $('#nama_toko_pelanggan').val("");
                    $('#penanggung_jawab').val("");
                    $('#alamat_toko_pelanggan').val("");
                    $('#no_telp').val("");
                    $('#pembelian_ke').val("0");
                }
            });
        });
    }
    function edit(id_toko_pelanggan){
        $(document).ready(function(){
            $('#tokoModal').modal('show');
            $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Toko');
            $('.modal-body form').attr('action','<?= '/adm/toko/edit_data' ?>');
            $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Toko');
            $.ajax({
                url : '<?= asset('/adm/toko/ambil_data') ?>',
                data : {id_toko : id_toko_pelanggan},
                method : 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'JSON',
                success:function(data){
                    $('#id_toko_pelanggan').val(data[0].id_toko_pelanggan);
                    $('#nama_toko_pelanggan').val(data[0].nama_toko_pelanggan);
                    $('#penanggung_jawab').val(data[0].penanggung_jawab);
                    $('#alamat_toko_pelanggan').val(data[0].alamat_toko_pelanggan);
                    $('#no_telp').val(data[0].no_telp);
                    $('#pembelian_ke').val(data[0].pembelian_ke);
                }
            });
       });
    }
</script>
@endpush