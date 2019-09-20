@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('harga.jual', $barang) }}">Nilai Tiket</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Nilai Tiket</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Tambah Nilai Tiket</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>

                    </div>
                <div class="box-body">
                  <form method="POST" id="myForm" action="{{ route('harga.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('POST') }}
                                    <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                                    <div class="form-group row">
                                        <label for="nama" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Nama') }}</label>

                                        <div class="col-md-6">
                                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $barang->nama) }}" required autocomplete="nama" autofocus disabled="">

                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="area" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Area') }}</label>

                                        <div class="col-md-6">
                                            <select class="js-example-basic-single form-control area" name="area_id">
                                              <option value=""></option>
                                              @foreach($area as $key)
                                              @if ($key->barangs->find($barang) == null)
                                                  {{-- expr --}}
                                                <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                              @endif
                                              @endforeach
                                            </select>
                                            @error('area')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="harga" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Harga') }}</label>

                                        <div class="col-md-6">
                                            <input id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" required autocomplete="harga" autofocus>

                                            @error('harga')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 col-md-offset-4 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Simpan') }}
                                            </button>
                                        </div>
                                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    
    <script> console.log('Hi!'); </script>
@stop

{{-- <div id="atur" class="tab-pane fade in active">
                        <form method="POST" id="myForm" action="{{ route('harga.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('POST') }}
                                    <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                                    <div class="form-group row">
                                        <label for="nama" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Nama') }}</label>

                                        <div class="col-md-6">
                                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $barang->nama) }}" required autocomplete="nama" autofocus disabled="">

                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="area" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Area') }}</label>

                                        <div class="col-md-6">
                                            <select class="js-example-basic-single form-control area" name="area_id">
                                              <option value=""></option>
                                              @foreach($area as $key)
                                              @if ($key->barangs->find($barang) == null)
                                                  {{-- expr --}}
                                                {{-- <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                              @endif
                                              @endforeach
                                            </select>
                                            @error('area')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="harga" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Harga') }}</label>

                                        <div class="col-md-6">
                                            <input id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" required autocomplete="harga" autofocus>

                                            @error('harga')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 col-md-offset-4 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Simpan') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                  </div> --}}