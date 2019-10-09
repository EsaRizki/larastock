@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        @if(Auth::user()->role->id == 1)
        <div class="col-md-12">
            <div class="box box-solid box-primary">
                <div class="box-header">Jumlah Barang</div>

                <div class="box-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <canvas id="chartTotal" width="400" height="150"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-solid box-primary">
                <div class="box-header">Statistik Barang Masuk</div>

                <div class="box-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <canvas id="chartMasuk" width="400" height="150"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-solid box-primary">
                <div class="box-header">Statistik Barang Keluar</div>

                <div class="box-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    <canvas id="chartKeluar" width="400" height="150"></canvas>
                </div>
            </div>
        </div>
            @else
            <div class="col-md-12">
            <div class="box box-solid box-primary">
                <div class="box-header">Selamat Datang
                <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div></div>

                <div class="box-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Selamat datang di aplikasi Larastock, silahkan cari informasi barang yang anda inginkan
                    <br>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@if(Auth::user()->role->id == 1)
    @section('js')
        <script> console.log('Hi!'); </script>
        <script>
            var data = {
                labels: {!! json_encode($lokasis) !!},
                datasets: [{
                    label: 'Jumlah barang keluar',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: "rgba(151,187,205,0.5)",
                    borderColor: "rgba(151,187,205,0.8)",
                }],
            };
            var options = {
                scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero:false,
                    stepSize: 20,
                    
                    }
                }]
                }
            };
            var ctx = document.getElementById("chartKeluar").getContext("2d");
            // For a pie chart
            var myPieChart = new Chart(ctx, {
                type: 'line',
                data: data,
                position:'bottom',
                options: options
            });
        </script>

        <script>
            var data = {
                labels: {!! json_encode($lokasis) !!},
                datasets: [{
                    label: 'Jumlah barang masuk',
                    data: <?php echo json_encode($masuk); ?>,
                    backgroundColor: "rgba(151,187,205,0.5)",
                    borderColor: "rgba(151,187,205,0.8)",
                }],
            };
            var options = {
                scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero:false,
                    stepSize: 20
                    }
                }]
                }
            };
            var ctx = document.getElementById("chartMasuk").getContext("2d");
            // For a pie chart
            var myPieChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        </script>
        <script>
            var data = {
                labels: {!! json_encode($lokasis) !!},
                datasets: [{
                    label: 'Total seluruh barang',
                    data: <?php echo json_encode($total); ?>,
                    backgroundColor: "rgba(151,187,205,0.5)",
                    borderColor: "rgba(151,187,205,0.8)",
                }],
            };
            var options = {
                scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero:false,
                    stepSize: 20
                    }
                }]
                }
            };
            var ctx = document.getElementById("chartTotal").getContext("2d");
            // For a pie chart
            var myPieChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: options
            });
        </script>
    @stop
@endif
{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 --}}