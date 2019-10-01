<div id="{{ $log->id . 'keranjang' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah barang ke keranjang </h4>
      </div>
      
      <div class="modal-body">
        <form method="POST" action="{{ route('cart.store') }}">
                      {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="barang_id" value="{{ $log->id }}">

                        <div class="form-group row">
                            <label for="nama" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ $log->nama }}" required disabled="" autocomplete="nama" autofocus>

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jumlah" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Jumlah') }}</label>

                            <div class="col-md-6">
                                <input id="jumlah" name="qty" type="number" min="1" max="{{ $log->stoks->sum('qty') }}" class="form-control @error('jumlah') is-invalid @enderror" value="{{ $log->qty }}" required autocomplete="jumlah" autofocus>

                                @error('jumlah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Keterangan" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Keterangan') }}</label>

                            <div class="col-md-6">
                                <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan') }}" autocomplete="keterangan" autofocus></textarea>
                                
                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
      </div>
      <div class="modal-footer">
        <button type="submit" value="submit" class="btn btn-primary">Simpan</button>
          <button type="reset" value="reset" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>

@section('js')

@stop