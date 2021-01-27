@extends('layouts.app',['title' => 'BMC | Stock Barang'])
@section('content')
@include('pages.Stock.modal')
<div class="col-md-12 p-3">
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <div class="col-lg-6 float-left">
                        <i class="fas fa-box-open h3"></i>
                        <font class="pl-3 mb-3 h3"> Stock Barang  </font> 
                    </div>
                    <div class="col-lg-6 float-left">
                        <div class="mb-3 text-right">
                            Tanggal : {{date("d/m/Y")}}
                        </div>
                    </div>
                </div>
                <div class="container"> <hr>
                    <div class="text-left float-left">
                        <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#stockModal"> <i class="fas fa-plus-circle"></i> Add Item</a>
                    </div>
                    <div class="text-left float-left pl-3">
                        <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#jenisModal"> <i class="fas fa-plus-circle"></i> Add Category</a>
                    </div>
                    <div class="text-left float-left pl-3">
                        <a class="btn btn-secondary" href="javascript:void(0)" data-toggle="modal" data-target="#viewjenisModal"> <i class="far fa-eye"></i> View Category</a>
                    </div>
                </div>
                <div class="container">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <tr>
                                <th> Id Barang </th> 
                                <th> Nama Barang </th> 
                                <th> Stock Barang </th> 
                                <th> Jenis Barang </th> 
                                <th> Satuan </th>
                                <th> Harga Minimal </th> 
                                <th> Harga Maximal </th> 
                                <th> Action </th>
                            </tr>
                           
                            @foreach($stock as $data)
                            <tr>
                                <td>{{$data->id_barang}}</td>
                                <td>{{$data->nama_barang}}</td>
                                <td>{{$data->stock_barang}}</td>
                                <td>{{$data->jenis_barang}}</td>
                                <td>{{$data->satuan}} </td>
                                <td>{{$data->harga_minimal}}</td>
                                <td>{{$data->harga_maximal}}</td>
                                <td>
                                    <form action="{{route('stock.destroy',$data)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#editStockModal" class="btn btn-warning text-white" data-stock="{{$data}}" onclick="edit_data(this)"> <i class="fas fa-pencil-alt"></i> </a> 
                                        <button class="btn btn-danger" onclick="hapus(event,this)"> <i class="fas fa-trash-alt"></i> </button>
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
    icon: '{{session()->has("icon") ? session("icon") : "success"}}',
    title: '{{session("judul_alert")}}\n{{session("status")}}',
    showConfirmButton: false,
    timer: 1500
  })
@endif
    function edit_data(e){
        var data = JSON.parse(e.dataset.stock);
        console.log(data);
        var form = document.getElementById('form-edit');
        $.each(data,function(k,v){
            if(form[k]){
                form[k].value = v;
            }
        });
    }

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
        ){
            swalWithBootstrapButtons.fire(
                'Batal',
                'Data batal terhapus',
                'error'
        )}
        });
    }
</script>
@endpush
