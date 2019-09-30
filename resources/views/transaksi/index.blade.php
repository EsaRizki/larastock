@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
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
                        {{-- <p><a class="btn btn-primary" href="#myModal" id="openBtn" data-toggle="modal" data-target="{{ '#' . 'cart' . 'modal' }}"><i class="fa fa-shopping-cart"></i> Cart</a></p>
                        @include('transaksi.cart') --}}
                  {{-- <form method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
                        @csrf --}}
                        {{-- <p>
                            <button type="submit" class="btn btn-primary">
                                    {{ __('Ambil') }}
                                </button>
                        </p> --}}
                       <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped display responsive nowrap compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Barang</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah Keseluruhan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @include('transaksi.detail_transaksi_admin')
                                @include('transaksi.detail_transaksi_member')
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Barang</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah Keseluruhan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                {{-- </form> --}}
        </div>
    </div>
</div>
@endsection

@section('js')
    
    <script> console.log('Hi!'); </script>
    
    <script>
      $(document).ready( function () {
        $('#examples').DataTable();
        $('#exampler').DataTable();

        $('#confirm').DataTable();
    } );
    </script>
@stop
