@extends('layouts.app')
@section('content')

@include('pages.Ekspedisi.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <div class="col-lg-6 float-left">
                        <i class="fas fa-dolly-flatbed h3"></i>
                        <font class="pl-3 mb-3 h3"> Ekspedisi   </font> 
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
                            <thead>
                                <tr>
                                    <th> ID Ekspedisi </th>
                                    <th> Nama Ekspedisi </th>
                                    <th> Alamat </th>
                                    <th> No Hp </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_ekspedisi as $ae)
                                    <tr>
                                        <td> {{$ae->id_ekspedisi}}</td>
                                        <td> {{$ae->nama_ekspedisi}} </td>
                                        <td> {{$ae->alamat}} </td>
                                        <td> {{$ae->no_telp}} </td>
                                        <td>
                                            <form action="<?= url('adm/ekspedisi/hapus_data') ?>" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id_ekspedisi" value="{{$ae->id_ekspedisi}}">
                                                <a href="javascript:void(0)" onclick="edit('<?= $ae->id_ekspedisi ?>')" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </a> 
                                                <button class="btn btn-danger" type="submit" onclick="hapus(event,this)"> <i class="fas fa-trash-alt"></i> </button>
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
  timer: 2000
})
@endif

    function hapus(e,btn){
            e.preventDefault();
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
            });
    }

    function tambah(){
        $(document).ready(function(){
            $('#ekspedisiModal').modal('show');
            $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Ekspedisi');
            $('.modal-body form').attr('action','<?= '/adm/ekspedisi/simpan_data' ?>');
            $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Simpan Data');
            $.ajax({
                url : '<?= asset('/adm/ekspedisi/ambil_id') ?>',
                method : 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'JSON',
                success:function(data){
                    $('#id_ekspedisi').val(data);
                    $('#nama_ekspedisi').val("");
                    $('#alamat').val("");
                    $('#no_telp').val("");
                }
            });
        });
    }
    function edit(id_ekspedisi){
        $(document).ready(function(){
            $('#ekspedisiModal').modal('show');
            $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Ekspedisi');
            $('.modal-body form').attr('action','<?= '/adm/ekspedisi/edit_data' ?>');
            $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
            $.ajax({
                url : '<?= asset('/adm/ekspedisi/ambil_data') ?>',
                data : {id_ekspedisi : id_ekspedisi},
                method : 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'JSON',
                success:function(data){
                    $('#id_ekspedisi').val(data[0].id_ekspedisi);
                    $('#nama_ekspedisi').val(data[0].nama_ekspedisi);
                    $('#alamat').val(data[0].alamat);
                    $('#no_telp').val(data[0].no_telp);
                }
            });
       });
    }
</script>
@endpush