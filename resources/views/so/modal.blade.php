<div id="{{ 'modal' }}" class="modal fade" role="dialog">
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
                      <th>Hasil So</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>

                  </tr>
              </thead>
              <tbody>
                @foreach($cart as $c)
                  <tr>
                    <td>{{ $c->barang->nama }}</td>
                    <td>{{ $c->barang->stoks->sum('qty') }}</td>
                    <td>{{ $c->qty }}</td>
                    <td>{{ $c->keterangan }}</td>
                    <td><form id="deleteCart" method="POST" action="{{ route('so.destroy', $c->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    <button type="submit" form="deleteCart" class="btn btn-warning btn-link btn-xs" onclick="return confirm('Apakah anda serius?')" value="Delete"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="Hapus"></span> </button>
                </form></td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>Jumlah</th>
                  <th>Hasil So</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
            </table>
          @endif
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
         --}}
        {{-- @endif --}}
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
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