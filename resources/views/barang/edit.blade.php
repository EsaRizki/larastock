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
                <li class="breadcrumb-item active" aria-current="page">Ubah Barang</li>
              </ol>
            </nav>
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#ubahBarang">Barang</a></li>
                          <li><a data-toggle="tab" href="#ubahLokasi">Lokasi</a></li>
                        </ul>
                    </div>
                <div class="box-body">
                    <div class="tab-content">
                        <div id="ubahBarang" class="tab-pane fade in active">
                            <form method="POST" action="{{ route('barang.update', $barang) }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <div class="form-group row">
                            <label for="nama" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $barang->nama) }}" required autocomplete="nama" autofocus>

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Foto') }}</label>

                            <div class="col-md-6">
                                <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value="{{ old('foto') }}" autocomplete="foto" autofocus onchange="openFile(event)">
                                <center>
                                @if (isset($barang) && $barang->foto)
                                <img id="output" class="img-rounded img-responsive " style="width: 20rem; height: 20rem" src="{!!asset('img/'.$barang->foto)!!}">
                              @else
                                 Foto belum di upload
                              @endif
                              </center>
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="kategori" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Kategori') }}</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-single form-control" name="kategori_id">
                                  @foreach($kategori as $key)
                                    <option value="{{ $key->id }}" {{ old('kategori_id', $barang->kategori_id) == $key->id ? 'selected' : '' }}>{{ $key->nama }}</option>
                                  @endforeach
                                </select>
                                @error('kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="kondisi" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Kondisi') }}</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-single form-control" name="kondisi" >
                                  <option value="" disabled selected hidden></option>
                                    <option value="0" {{ $barang->kondisi == 0 ? 'selected' : '' }}>Baru</option>
                                    <option value="1" {{ $barang->kondisi == 1 ? 'selected' : '' }}>Bekas</option>
                                    <option value="2" {{ $barang->kondisi == 2 ? 'selected' : '' }}>Rusak</option>
                                </select>

                                @error('kondisi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="harga" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Harga') }}</label>

                            <div class="col-md-6">
                                <input id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga', $barang->harga) }}" required autocomplete="harga" autofocus>

                                @error('harga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <div class="form-check">
                            @if($barang->areas != '[]')
                            <input type="checkbox" class="form-check-input" checked="" id="exampleCheck1" name="nilaiTiket">
                            @else
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="nilaiTiket">
                            @endif
                            <label class="form-check-label" for="exampleCheck1">Atur nilai tiket</label>
                          </div>
                        </div>
                    </div>

                        <div class="form-group row">
                            <label for="jumlah" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Jumlah') }}</label>

                            <div class="col-md-6">
                                <input id="jumlah" type="number" class="form-control @error('jumlah') is-invalid @enderror" name="qty" value="{{ old('jumlah', $barang->stoks->first()->qty) }}" required autocomplete="jumlah" autofocus>

                                @error('jumlah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="satuan" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Satuan') }}</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-single form-control" name="satuan_id">
                                  @foreach($satuan as $key)
                                    <option value="{{ $key->id }}" {{ old('satuan_id', $barang->satuan_id) == $key->id ? 'selected' : '' }}>{{ $key->nama }}</option>
                                  @endforeach
                                </select>
                                @error('satuan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Keterangan" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('keterangan') }}</label>

                            <div class="col-md-6">
                                <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan', $barang->keterangan) }}" autocomplete="keterangan" autofocus>{{ $barang->keterangan }}</textarea>
                                @error('keterangan')
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
          
                      <div id="ubahLokasi" class="tab-pane fade">
                         <form method="POST" action="{{ route('barang.lokasi', $barang) }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
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
                            <label for="gudang" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Gudang') }}</label>
                            <div class="col-md-6">
                                    {{-- <option value="{{ $e->id }}" {{ old('lokasi_id', $barang->lokasi_id) == $lok->id ? 'selected' : '' }}>{{ $lok->parent->nama }}</option> --}}
                                <select class="js-example-basic-single form-control gudang" name="gudang_id" style="width: 100%">
                                  <option value="" disabled selected></option>
                                  @foreach($gudang as $key)
                                    <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                  @endforeach
                                  {{-- @foreach ($gudang as $gu)
                                  @foreach($lokasi as $key)
                                  @endforeach
                                    <option value="{{ $key->parent->id }}" {{ old('lokasi_id', $barang->lokasi_id) == $key->id ? 'selected' : '' }}>{{ $key->parent->nama }}</option>
                                  @endforeach --}}
                                </select>
                                @error('lokasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lokasi" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Lokasi') }}</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-single form-control lokasi" name="lokasi_id" style="width: 100%">
                                  @foreach($lokasi as $key)
                                    <option value="{{ $key->id }}" {{ old('lokasi_id', $barang->lokasi_id) == $key->id ? 'selected' : '' }}>{{ $key->nama }}</option>
                                  @endforeach
                                </select>
                                @error('lokasi')
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
    <script>
    var openFile = function(event) {
    var input = event.target;

    var reader = new FileReader();
    reader.onload = function(){
      var dataURL = reader.result;
      var output = document.getElementById('output');
      output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
  };
</script>
{{-- <script>
    var $company2 = $('.gudang');
    var $location2 = $(".lokasi");

    $company2.select2().on('change', function() {
        $.ajax({
            url:"/lokasi/cari/" + $company2.val(),
            type:'GET',
            success:function(data) {
                console.log(data);
                $location2.empty();
                $.each(data, function(value, key) {
                    var data = {
                        id: value,
                        text: key
                    };
                                  

                    var newOption = new Option(data.text, data.id, false, true);
                    
                    $location2.append(newOption).trigger('change');

                    
                });
                $location2.select2(); 
            }
        });
    }).trigger('change');
</script> --}}
<script>
    var $company2 = $('.gudang');
    var $location2 = $(".lokasi");

    $company2.select2().on('change', function() {
        $.ajax({
            url:"/lokasi/cari/" + $company2.val(), // if you say $(this) here it will refer to the ajax call not $('.company2')
            type:'GET',
            success:function(data) {
                $location2.empty();
                $.each(data, function(value, key) {
                    $location2.append($("<option></option>").attr("value", value).text(key)); // name refers to the objects value when you do you ->lists('name', 'id') in laravel
                });
                $location2.select2(); //reload the list and select the first option
            }
        });
    }).trigger('change');
</script>
@stop
