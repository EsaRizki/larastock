@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Stok {{ $barang->nama }}</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Daftar Stok {{ $barang->nama }}</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>

                    </div>
                <div class="box-body">
                    {{-- <p><a class="btn btn-primary" href="{{ route('stok.create', $barang) }}">Tambah</a></p> --}}
                   <div class="table table-responsive">
                        <table id="example" class="table table-bordered table-striped display responsive nowrap compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Sisa</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                    $jumlah = count($barang->stoks);
                                    $start = 0;
                                    $st = 0;
                                    $awal = $barang->stoks->first()->qty;
                                @endphp
                                @php
                                    foreach ($barang->stoks as $log) {
                                        # code...
                                        $sisa = $start + $log->qty;
                                        $start = $sisa;
                                    }

                                @endphp
                                @foreach ($barang->stoks as $log)
                                
                                    <tr>   
                                @if (is_null($log->transaksi_id))                                    {{-- {{ $start }} --}}
                                        <td>
                                            {{ $barang->user->name }}
                                        </td>
                                        @elseif (!is_null($log->transaksi_id))
                                        <td>{{ $log->transaksi->users->name }}</td>
                                @endif

                                @if (!isset($log->transaksi_id))
                                        <td>Masuk</td>
                                    @else
                                <td>Keluar</td>
                                @endif
                                @if (is_null($log->transaksi_id) && is_null($log->keterangan))
                                    <td>Stok Awal</td>
                                    @elseif (is_null($log->transaksi_id) && !is_null($log->keterangan))
                                    <td>{{ $log->keterangan }}</td>
                                     @elseif (!is_null($log->transaksi_id) && is_null($log->keterangan))
                                    <td>{{ $log->transaksi->keterangan }}</td>               
                                @endif
                                <td>{{ $log->qty }}</td>
                                @php
                                    $awal = $log->first()->sisa;
                                @endphp
                                {{-- @if ($loop->first)
                                        <td>{{ $awal }}</td>
                                    @else

                                oKw
                                    
                                @endif --}}
                                @php
                                    $sis = $st + $log->qty;
                                    $st = $sis;
                                @endphp     
                                        <td>{{ $st }}</td>
                                        <td>{{ $log->created_at }}</td>
                                        <td>
                                         
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Sisa</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    
    <script> console.log('Hi!'); </script>
@stop
