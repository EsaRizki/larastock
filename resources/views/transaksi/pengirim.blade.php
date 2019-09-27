<div id="{{ $log->id . 'pengirim' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Pengirim</h4>
      </div>
      <div class="modal-body">
      	<form method="POST" action="{{ route('suratJalan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="transaksi_id" value="{{ $log->id }}">
                        <div class="form-group row">
                            <label for="pengirim" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Pengirim') }}</label>

                            <div class="col-md-6">
                                <input id="pengirim" type="text" class="form-control @error('pengirim') is-invalid @enderror" name="pengirim" value="{{ old('pengirim') }}" required autocomplete="pengirim" autofocus>

                                @error('pengirim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jenis" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Jenis') }}</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-single form-control" style="width: 100%" name="jenis">
                                  <option value="" disabled selected></option>
                                    <option value="0">Barang</option>
                                    <option value="1">Mesin</option>
                                </select>

                                @error('jenis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hp" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Hp') }}</label>

                            <div class="col-md-6">
                                <input id="hp" type="text" class="form-control @error('hp') is-invalid @enderror" name="hp" value="{{ old('hp') }}" required autocomplete="hp" autofocus>

                                @error('hp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_polisi" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('No Polisi') }}</label>

                            <div class="col-md-6">
                                <input id="no_polisi" type="text" class="form-control @error('no_polisi') is-invalid @enderror" name="no_polisi" value="{{ old('no_polisi') }}" required autocomplete="no_polisi" autofocus>

                                @error('no_polisi')
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
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
