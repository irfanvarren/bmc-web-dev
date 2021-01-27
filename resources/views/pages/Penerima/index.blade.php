@extends('layouts.app')
@section('content')
@include('pages.Penerima.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <div class="col-lg-6 float-left">
                        <i class="fas fa-handshake h3"></i>
                        <font class="pl-3 mb-3 h3"> Penerima  </font> 
                    </div>
                    <div class="col-lg-6 float-left">
                        <div class="mb-3 text-right">
                            Tanggal : {{date("d/m/Y")}}
                        </div>
                    </div>
                </div>
                <div class="container"> <hr>
                    <div class="text-left">
                        <a class="btn btn-primary" href="javascript:void(0)"  onclick="tambah()"> <i class="fas fa-plus-circle"></i> Add </a>
                    </div>
                </div>
                <div class="container">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <colgroup>
                                <col><col><col><col><col><col><col><col style="width: 11%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th> ID Penerima </th>
                                    <th> Nama Penerima </th>
                                    <th> No HP </th>
                                    <th> Alamat </th>
                                    <th> Provinsi </th>
                                    <th> Kota </th>
                                    <th> Kode Pos </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($semua as $s)
                                <tr>
                                   <td>{{$s->id_penerima}}</td>
                                   <td>{{$s->nama_penerima}}</td>
                                   <td>{{$s->no_hp}}</td>
                                   <td>{{$s->alamat}}</td>
                                   <td>{{$s->provinsi}}</td>
                                   <td>{{$s->kota}}</td>
                                   <td>{{$s->kode_pos}}</td>
                                    <td>
                                        <form action="{{url('adm/penerima/hapus_data')}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id_penerima" value="{{$s->id_penerima}}">
                                            <a href="javascript:void(0)" onclick="edit('<?= $s->id_penerima ?>')" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </a> 
                                            <button class="btn btn-danger" onclick="hapus(event,this)"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
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
            $('#penerimaModal').modal('show');
            $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Penerima');
            $('.modal-body form').attr('action','<?= '/adm/penerima/simpan_data' ?>');
            $('.modal-footer button[type=submit]').html('<i class="fas fa-save"></i> Simpan Data');
            $.ajax({
                url : '<?= asset('/adm/penerima/ambil_id') ?>',
                method : 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'JSON',
                success:function(data){
                    $('#id_penerima').val(data);
                    $('#nama_penerima').val("");
                    $('#no_hp').val("");
                    $('#alamat').val("");
                    $('#provinsi').val();
                    $('#kota').val();
                    $('#kode_pos').val("");
                }
            });
        });
    }
    function edit(id_penerima){
        $(document).ready(function(){
            $('#penerimaModal').modal('show');
            $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Toko');
            $('.modal-body form').attr('action','<?= '/adm/penerima/edit_data' ?>');
            $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Toko');
            $.ajax({
                url : '<?= asset('/adm/penerima/ambil_data') ?>',
                data : {id_penerima : id_penerima},
                method : 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'JSON',
                success:function(data){
                    $('#id_penerima').val(data[0].id_penerima);
                    $('#nama_penerima').val(data[0].nama_penerima);
                    $('#no_hp').val(data[0].no_hp);
                    $('#alamat').val(data[0].alamat);
                    $('#provinsi').val(data[0].provinsi);
                    $('#kota').val(data[0].kota);
                    $('#kode_pos').val(data[0].kode_pos);
                }
            });
       });
    }
</script>
@endpush