@extends('layouts.app',['title' => 'Statistik'])

@section('content')
<div class="container">
    <div class="p-3">
        <i class="fas fa-tachometer-alt h3"></i>
        <font class="h3"> Statistik </font>
        <hr>
    </div>
    <div>
        <canvas id="myChart" style="height:500px;"></canvas>
    </div>
</div> 
@endsection
@push('js')
<script src="{{asset('js/Chart.js')}}"></script>
<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September','November','Desember'],
        datasets: [{
            label: 'Penjualan',
            data: {!!json_encode($penjualan)!!},
            borderColor:"blue",
            borderWidth: 1
        },
        {
            label: 'Pembelian',
            data: {!!json_encode($pembelian)!!},
            borderColor:"red",
            borderWidth: 1
        }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endpush