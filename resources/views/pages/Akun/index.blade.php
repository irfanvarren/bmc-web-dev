@extends('layouts.app',['title' => 'BMC | Akun'])
@section('content')
@include('pages.Akun.modal')
@if(session()->has('message'))
<div class="alert alert-success col-md-12">
    {!!session('message')!!}
</div>
@endif
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <div class="col-lg-6 float-left">
                        <i class="fas fa-user-plus h3"></i>
                        <font class="pl-3 mb-3 h3"> Akun  </font> 
                    </div>
                </div>
                <div class="container"> <hr>
                    <div class="text-left">
                        <a class="btn btn-primary"  href="javascript:void(0)" data-toggle="modal" data-target="#akunModal"> <i class="fas fa-plus-circle"></i> Add </a>
                    </div>
                </div>
                <div class="container">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <tr>
                                <th> Username </th> 
                                <th> Nama </th>
                                <th> Email </th> 
                                <th> No Telepon </th> 
                                <th> Penerima </th> 
                                <th> Status </th>  
                                <th> Action </th>
                            </tr>
                            @foreach($akun as $data)
                            <tr>
                                <td>
                                    <div>{{$data->username ?: "-"}}</div>
                                    <div><img src="{{Storage::disk('public')->url($data->foto)}}" style="max-width:140px;" alt=""></div>
                                </td>
                                <td>{{$data->nama_akun}}</td>
                                <td>{{$data->email_akun}}</td>
                                <td>{{$data->no_hp ?: "-"}}</td>
                                <td>{{$data->id_penerima ?: "-"}}</td>
                                <td>{{$data->status ?: "-"}}</td>
                                <td>
                                    <form action="{{route('akun.delete',$data)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:void(0)" onclick="edt(this)"  data-toggle="modal" data-target="#editAkunModal" data-akun='{"id_akun":{{$data->id_akun}},"nama_akun":"{{$data->nama_akun}}","username":"{{$data->username}}","no_hp":"{{$data->no_hp}}","email_akun":"{{$data->email_akun}}"}' class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </a> 
                                        <button class="btn btn-danger"> <i class="fas fa-trash-alt"></i> </button>
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
    function edt(e){
        console.log(e.dataset.akun);
        var data = JSON.parse(e.dataset.akun);
        var form = document.getElementById('form-edit');
        $.each(data,function(k,v){
            if(form[k]){
                form[k].value = v;
            }
        });
    }
</script>
@endpush