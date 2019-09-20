@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Barang</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Detail Barang</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                   <div class="table-responsive">
                        <table border="1" id="example" class="display responsive nowrap compact" style="width:100%">
                            <tr>
                                <td colspan="2">@if (isset($barang) && $barang->foto)
                                     <center><img class="img-rounded img-responsive " style="width: 120px; height: 120px" src="{!!asset('img/'.$barang->foto)!!}"> </center>
                                      @else
                                         Foto belum di upload
                                      @endif
                                  </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center; font-size: 20px;">{{ $barang->nama }}</td>
                            </tr>
                            <tr>
                                <td>{{ $barang->lokasi->nama }}</td>
                                <td>Sisa {{ $barang->jumlah - $barang->carts->sum('qty') }}</td>
                            </tr>
                        </table>
                    </div>

        </div>
    </div>
</div>
@endsection

@section('js')
    
    <script> console.log('Hi!'); </script>
@stop
