@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="p-3">
                <i class="fas fa-tachometer-alt h3"></i>
                <font class="h3"> Dashboard </font>
                <hr>
            </div>
            <div class="col-lg-3 mb-3 col-6 float-left text-white"> 
                <div style="background-color: #0cb95d;height:100px">
                    <div class="col-lg-7 col-7 float-left">
                        <div class="float-left pt-3">
                            <font class="h3"> 99.190.918 </font>
                        </div>
                        <div class="float-left">
                            <font class="float-left"> Best Seller </font>
                        </div>
                    </div>
                    <div class="col-lg-5 col-5 pt-3 float-left">
                        <i class="fas fa-thumbs-up" style="font-size: 60px;opacity: 30%;"></i>
                    </div>
                </div>
                <div style="background-color: #0fa64d;height:30px">
                    <center>
                        Read More 
                        <i class="fas fa-play-circle"></i>
                    </center>
                </div>
            </div>
            <div class="col-lg-3 mb-3 col-6 float-left text-white"> 
                <div style="background-color: #6054a6;height:100px">
                    <div class="col-lg-7 col-7 float-left">
                        <div class="float-left pt-3">
                            <font class="h3"> 123.118 </font>
                        </div>
                        <div class="float-left ">
                            <font class="float-left"> Payment </font>
                        </div>
                    </div>
                    <div class="col-lg-5 col-5 pt-3 float-left">
                        <i class="fas fa-credit-card" style="font-size: 60px;opacity: 30%;"></i>
                    </div>
                </div>
                <div style="background-color: #564c92;height:30px">
                    <center>
                        Read More 
                        <i class="fas fa-play-circle"></i>
                    </center>
                </div>
            </div>
            <div class="col-lg-3 mb-3 col-6 float-left text-white"> 
                <div style="background-color: #ce393b;height:100px">
                    <div class="col-lg-7 col-7 float-left">
                        <div class="float-left pt-3">
                            <font class="h3"> {{$retur_penjualan}} </font>
                        </div>
                        <div class="float-left ">
                            <font class="float-left"> Retur Penjualan </font>
                        </div>
                    </div>
                    <div class="col-lg-5 col-5 pt-3 float-left">
                        <i class="fas fa-exchange-alt" style="font-size: 60px;opacity: 30%;"></i>
                    </div>
                </div>
                <div style="background-color: #c23132;height:30px">
                    <center>
                        Read More 
                        <i class="fas fa-play-circle"></i>
                    </center>
                </div>
            </div>
            <div class="col-lg-3 mb-3 col-6 float-left text-white"> 
                <div style="background-color: #f07d24;height:100px">
                    <div class="col-lg-8 col-8 float-left">
                        <div class="float-left pt-3">
                            <font class="h3"> {{$retur_pembelian}} </font>
                        </div>
                        <div class="float-left">
                            <font class="float-left"> Retur Pembelian </font>
                        </div>
                    </div>
                    <div class="col-lg-4 col-4 pt-3 pl-1 float-left">
                        <i class="fas fa-exchange-alt" style="font-size: 60px;opacity: 30%;"></i>
                    </div>
                </div>
                <div style="background-color: #dc6e1f;height:30px">
                    <center>
                        Read More 
                        <i class="fas fa-play-circle"></i>
                    </center>
                </div>
            </div>
            <div class="col-lg-3 mb-3 col-6 float-left text-white"> 
                <div style="background-color:  #6054a6;height:100px">
                    <div class="col-lg-7 col-7 float-left">
                        <div class="float-left pt-3">
                            <font class="h3"> {{$stock}} </font>
                        </div>
                        <div class="float-left">
                            <font class="float-left"> Stock Barang </font>
                        </div>
                    </div>
                    <div class="col-lg-5 col-5 pt-3 float-left">
                        <i class="fas fa-box-open h5" style="font-size: 60px;opacity: 30%;"></i>
                    </div>
                </div>
                <div style="background-color: #564c92;height:30px">
                    <center>
                        Read More 
                        <i class="fas fa-play-circle"></i>
                    </center>
                </div>
            </div>
            <div class="col-lg-3 mb-3 col-6 float-left text-white"> 
                <div style="background-color: #46a271;height:100px">
                    <div class="col-lg-7 col-7 float-left">
                        <div class="float-left pt-3">
                            <font class="h3"> {{$pembelian}} </font>
                        </div>
                        <div class="float-left ">
                            <font class="float-left"> Pembelian Item </font>
                        </div>
                    </div>
                    <div class="col-lg-5 col-5 pt-3 float-left">
                        <i class="fas fa-shopping-cart h5" style="font-size: 60px;opacity: 30%;"></i>
                    </div>
                </div>
                <div style="background-color:#3d9268;height:30px">
                    <center>
                        Read More 
                        <i class="fas fa-play-circle"></i>
                    </center>
                </div>
            </div>
            <div class="col-lg-3 mb-3 col-6 float-left text-white"> 
                <div style="background-color: #f07d24;height:100px">
                    <div class="col-lg-7 col-7 float-left">
                        <div class="float-left pt-3">
                            <font class="h3"> {{$penjualan}} </font>
                        </div>
                        <div class="float-left ">
                            <font class="float-left"> Penjualan Item </font>
                        </div>
                    </div>
                    <div class="col-lg-5 col-5 pt-3 float-left">
                        <i class="fas fa-coins h5" style="font-size: 60px;opacity: 30%;"></i>
                    </div>
                </div>
                <div style="background-color: #dc6e1f;height:30px">
                    <center>
                        Read More 
                        <i class="fas fa-play-circle"></i>
                    </center>
                </div>
            </div>
            <a class="col-lg-3 mb-3 col-6 float-left text-white" href="{{url('adm/dashboard/statistik')}}"> 
                <div style="background-color: #ce393b;height:100px">
                    <div class="col-lg-7 col-7 float-left">
                        <div class="float-left pt-3">
                            <font class="h3"> Statistik </font>
                        </div>
                        <div class="float-left ">
                            <font class="float-left"> B.M.C  </font>
                        </div>
                    </div>
                    <div class="col-lg-5 col-5 pt-3 float-left">
                        <i class="fas fa-chart-pie" style="font-size: 60px;opacity: 30%;"></i>
                    </div>
                </div>
                <div style="background-color: #c23132;height:30px">
                    <center>
                        Read More 
                        <i class="fas fa-play-circle"></i>
                    </center>
                </div>
        </a>
@endsection()