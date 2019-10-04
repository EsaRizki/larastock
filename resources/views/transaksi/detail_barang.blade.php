<div id="{{ $log->id . 'barang' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Barang</h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive form-group">
           <table id="exampler" class="display responsive nowrap compact" style="width:100%">
              <thead>
                  <tr>
                      <th>Nama</th>
                      <th>Asal Lokasi</th>
                      <th>Jumlah</th>
                      
                  </tr>
              </thead>
              <tbody>
                @foreach ($log->carts as $el)
                  <tr>
                    <td>{{ $el->barang->nama }}</td>
                    <td>{{ $el->barang->lokasi->nama }}</td>
                    <td>{{ $el->qty }}</td>
                    
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>Asal Lokasi</th>
                  <th>Jumlah</th>
                  
                </tr>
              </tfoot>
            </table>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
