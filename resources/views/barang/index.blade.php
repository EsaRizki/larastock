@extends('adminlte::page')

@section('title', 'Data Barang')


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
                        <h2 class="box-title">Daftar Barang</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                  <p>
                    @if (Auth::user()->role_id == 1)
                    <a class="btn btn-primary" href="{{ route('barang.create') }}">Tambah</a>
                    @endif
                    
                    @if (Auth::user()->role_id == 2)
                    <a class="btn btn-primary" href="#myModal" id="openBtn" data-toggle="modal" data-target="{{ '#' . 'cart' . 'modal' }}"><i class="fa fa-shopping-cart"></i> Cart <span class="badge">@if (count($badge->where('status',0)) != 0)
                        {{ $badge->where('status', 0)->sum('qty') }}
                    @endif</span></a>
                        @include('transaksi.cart')
                    @endif
                  </p>
                   <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped display responsive nowrap compact" cellspacing="0" >
                            @if (Auth::user()->role_id == 1)
                                @include('barang.tabel_admin')
                            @endif

                            @if (Auth::user()->role_id == 2)
                                @include('barang.tabel_member')
                            @endif
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
   
    <script> console.log('Hi!'); </script>
    <script>
        function init() {
  document.getElementById("upload_form").reset();
}

window.onload = init;
    </script>
@stop
