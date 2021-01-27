@extends('layouts.app')
@section('content')

<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <center>
                        <div class="col-lg-12">
                            <h3> PROFILE </h3>
                        </div>
                        <div class="col-lg-6">
                            <img src="{{asset('/img/User Transparent.png')}}" style="border: 1px solid black" alt="Profile">
                            <div class="col-lg-6">
                                <input type="file"  id="file" class="inputfile">
                                <label for="file" class="cr-pointer mt-1"> <u> Choose a file </u></label>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('akun.update.profile') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-8 mt-3 form-group">
                                <div class="row form-group">
                                    <div class="col-xl-6">
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <label for="id_barang"> Nama </label>
                                            </div>
                                            <div class="col-xl-8">
                                                <input type="text" class="form-control" value="{{$all_profile->nama_akun}}" id="nama_akun" name="nama_akun" placeholder="Nama">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="row ">
                                            <div class="col-xl-4">
                                                <label for="id_barang"> Email  </label>
                                            </div>
                                            <div class="col-xl-8">
                                                <input type="email"  class="form-control" value="{{$all_profile->email_akun}}" id="email_akun" name="email_akun" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xl-6">
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <label for="id_barang"> Username </label>
                                            </div>
                                            <div class="col-xl-8">
                                                <input type="text" value="{{$all_profile->username}}" class="form-control" id="username" name="username" placeholder="Username">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="row ">
                                            <div class="col-xl-4">
                                                <label for="id_barang"> No Hp  </label>
                                            </div>
                                            <div class="col-xl-8">
                                                <input type="text" value="{{$all_profile->no_hp}}"  class="form-control" id="no_hp" name="no_hp" placeholder="No Hp">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xl-6">
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <label for="id_barang"> Password </label>
                                            </div>
                                            <div class="col-xl-8">
                                                <input type="password" class="form-control" value="" id="password" name="password" placeholder="******">
                                                <div  class="float-left mt-1">
                                                    <input type="checkbox"> Liat Password
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="row ">
                                            <div class="col-xl-4">
                                                <label for="id_barang"> Level  </label>
                                            </div>
                                            <div class="col-xl-8">
                                                <input type="text" readonly value="{{$all_profile->level}}" class="form-control" id="level" name="level" placeholder="Level">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 text-right">
                                <button class="btn btn-primary"> <i class="fas fa-save"></i> Simpan </button>
                            </div>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
