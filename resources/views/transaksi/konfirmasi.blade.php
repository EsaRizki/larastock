<div id="{{ $log->id . 'konfirmasi' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi jumlah barang yang diterima</h4>
      </div>
      <div class="modal-body">
      	<div class="table table-responsive form-group">
            <table id="confirm" class="display responsive nowrap compact" style="width:100%">
              <thead>
                  <tr>
                      <th>Nama</th>
                      <th>Jumlah</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($log->carts as $cart)
                    @if($cart->status == 1)
                    <tr>
                        <td>{{ $cart->barang->nama }}</td>
                        <form action="{{ route('transaksi.confirm') }}" method="post" accept-charset="utf-8">
                            {{ csrf_field() }}
                            <input type="hidden" name="barang_id" value="{{ $cart->barang_id }}">
                            <input type="hidden" name="transaksi_id" value="{{ $log->id }}">
                            <td>
                                <input type="number" name="qty" min="0"  value="{{ $cart->qty }}" class="form-control">
                            </td>
                            <td><button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-ok" aria-hidden="true" data-toggle="tooltip" title="Selesaikan"></span></button></td>
                        </form>
                    </tr>
                    @endif
                  @endforeach
              </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
