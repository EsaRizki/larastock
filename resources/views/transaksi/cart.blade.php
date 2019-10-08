<div id="{{ 'cart' . 'modal' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail </h4>
      </div>
      
      <div class="modal-body">
        <div class="table table-responsive form-group">
          @if (Auth::user()->carts != null)
            <table id="examples" class="display responsive nowrap compact" style="width:100%">
              <thead>
                  <tr>
                      <th>Nama</th>
                      <th>Jumlah</th>
                      <th>Aksi</th>

                  </tr>
              </thead>
              <tbody>
              @foreach ($cart as $e)
                @if ($e->user_id == Auth::id() && $e->status == 0)
                <tr>
                  <td>{{ $e->barang->nama }}</td>
                  <input type="hidden" name="cart[]" value="{{ $e->id }}">
                  <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                  
                  <td>{{ $e->qty }}</td>
                  <td>@include('transaksi.cart_action')</td>
        
                </tr>
                @endif
              @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>Jumlah</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
            </table>
          @endif
        </div>
      </div>
        <form id="makeTransaksi" method="POST" action="{{ route('transaksi.store') }}">
          {{ csrf_field() }}
          @if (Auth::user()->carts != null)
          @foreach ($cart as $el)
                @if ($el->user_id == Auth::id() && $el->status == 0)
                <input type="hidden" name="cart[]" value="{{ $el->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="barang_id[]" value="{{ $el->barang_id }}">
                
                <input type="hidden" name="qty" value="{{ $el->qty }}">
                @endif
          @endforeach
          @endif
          <div class="modal-body">
            <div class="form-group row">
                            <label for="kategori" class=" col-md-2 control-label col-form-label text-md-right">{{ __('Tujuan') }}</label>

                            <div class="col-md-6">
                                <select style="width: 100%;" class="cart"  name="gedung_id">
                                  @foreach($gedung as $key)
                                    <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                  @endforeach
                                </select>

                                @error('gedung')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


          
          </div>
      <div class="modal-footer">
        {{-- @php
          $data = 1;
        @endphp
        @foreach ($cartUser as $key)
          
        @for ($i = 0; $i < count($cartUser); $i++)
          @php
            $min = $key->barang->stock - $key->qty;
            if ($min < 0) {
              $data = 0;
            }

          @endphp
        @endfor
        @endforeach
         --}}
        {{-- <input type="hidden" name="data" value="{{ $data }}">
        @if ($data == 0)
        <a tabindex="0" class="btn btn-danger" role="button" data-toggle="popover" data-trigger="focus" title="Gagal" data-placement="left" data-content="Jumlah stok tidak mencukupi, silahkan sesuaikan kembali jumlah barang anda">Ambil</a>
        @endif
        @if ($data == 1)
         --}}<button type="submit" form="makeTransaksi" class="btn btn-primary">Ambil</button>
        {{-- @endif --}}
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>

@section('js')
<script>
  $(document).ready( function () {
    $('#examples').DataTable({
      "pageLength": 5,
      "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, 'All']]
    });

   $('.cart').select2({
        placeholder: 'Silahkan pilih data',
        allowClear: true,
        dropdownParent: $("#cartmodal")
    });
} );
</script>
@stop