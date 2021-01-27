<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title> {{$title}} </title>
<head>
<!-- Head -->
@include('includes.head')

<!-- Styles and Scripts -->
@stack('head-script')
</head>
<body>
<div class="container-fluid">
<header>
@include('includes.header')
</header>

<main class="row">

@include('includes.sidebar')
<div class="float-left" style="background-color: #f3F3F3" id="content">
<div class="row">
@yield('content')
</div>
</div>
</main>

<footer>
@include('includes.footer')
</footer>
</div>


<script src="<?= asset('/js/jquery-3.5.1.js') ?>"></script>
<script src="<?= asset('/js/bootstrap.js') ?>"></script>
<script src="{{asset('/js/font-awesome.js')}}"></script>
<script src="{{asset('/js/select2.full.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
$(document).ready(function(){
    $('#retur').click(function(){
        $('#retur_penjualan').slideToggle("slow");
        $('#retur_pembelian').slideToggle("slow");
    });
    $('#penjualan').click(function(){
        $('#nota_penjualan').slideToggle("slow");
        $('#buat_nota_penjualan').slideToggle("slow");
    });
    $('#pembelian').click(function(){
        $('#nota_pembelian').slideToggle("slow");
        $('#buat_nota_pembelian').slideToggle("slow");
    });
    $('#menu').click(function(){
        var header = $('#header').attr('class');
        $('#logo').slideToggle();
        // $('#side_bar').slideToggle();
        if(header == "col-lg-10 float-left pb-3 bg-blue-gray"){
            $('#header').removeClass("col-lg-10 float-left pb-3 bg-blue-gray");
            $('#header').addClass("col-lg-12 float-left pb-3 bg-blue-gray");   
            $('#side_bar').addClass("hide");
            $('#content').addClass("full-width")
            // $('#content').removeClass("col-lg-10 float-left");
            // $('#content').addClass('col-lg-12 flaot-left'); 
        }else{
            $('#header').removeClass("col-lg-12 float-left pb-3 bg-blue-gray");
            $('#header').addClass("col-lg-10 float-left pb-3 bg-blue-gray");   
            $('#side_bar').removeClass("hide");
            $('#content').removeClass("full-width")
            // $('#content').removeClass("col-lg-12 float-left");
            // $('#content').addClass('col-lg-10 flaot-left');  
        }
    });
});
</script>
@stack('js')
</body>

</html>

