@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail transaksi pada {{ $barang->nama }}</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Daftar Transaksi</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                   <div class="table-responsive">
                        <table id="example" class="display responsive nowrap compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Stok Awal</th>
                                    <th>Jumlah Ambil</th>
                                    <th>Sisa</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Ambil</th>
                                    <th>Aksi</th>
                                    
                                </tr>
                            </thead>
                            <tbody> 
                                {{-- @php
                                    $stok = $barang->jumlah;
                                    $cart = $barang->carts->count();
                                    // $sisa = $stok - $log->qty;
                                    foreach ($barang->carts as $log) {
                                        $kurang = $log->qty;
                                        $si = $stok - $kurang;
                                        $stok = $si;
                                        $nama = $log->user->name;
                                        foreach ($log->transaksis as $e) {
                                            echo 
                                            "<tr>
                                            <td>$nama</td>
                                            <td>$barang->jumlah</td>
                                            <td>$log->qty</td>
                                            <td>$stok</td>
                                            <td>$e->keterangan</td>
                                            <td>$e->created_at</td>
                                            </tr>";
                                         } 
                                    }
                                @endphp --}}
                                @foreach ($barang->carts as $log)
                                @php
                                $kurang = $log->qty;
                                $si = $stok - $kurang;
                                $stok = $si;
                                @endphp
                                @if ($log->status == 1)
                                    <tr>   
                                        <td>
                                            {{ $log->user->name }}
                                        </td>
                                        <td>{{ $barang->jumlah }}</td>
                                        <td>{{ $log->qty }}</td>
                                        <td>{{ $stok }}</td>
                                        @foreach ($log->transaksis as $e)
                                            <td>{{ $e->keterangan }}</td>
                                            <td>{{ $e->created_at }}</td>
                                        @endforeach  
                                        <td></td>  
                                    </tr>
                                @endif
                                @endforeach
                                
                                {{-- @foreach ($barang->carts as $log)
                                    <tr>   
                                        <td>
                                            {{ $log->user->name }}
                                        </td>
                                        <td>{{ $stok }}</td>
                                        <td>
                                            {{ $log->qty }}
                                        </td>
                                        <td>{{ $barang->jumlah - $log->qty }}</td>
                                        @foreach ($log->transaksis as $e)
                                            <td>{{ $e->keterangan }}</td>
                                            <td>{{ $e->created_at }}</td>
                                        @endforeach
                                        
                                    </tr>
                                @endforeach --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Stok Awal</th>
                                    <th>Jumlah Ambil</th>
                                    <th>Sisa</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Ambil</th>
                                    <th>Aksi</th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>

        </div>
    </div>
</div>
@endsection

@section('js')
    
    <script> console.log('Hi!'); </script>
@stop
