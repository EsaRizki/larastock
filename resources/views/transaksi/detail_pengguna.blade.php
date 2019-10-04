<div id="{{ $log->id . 'pengguna' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Pengguna</h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive form-group">
           <table id="examples" class="display responsive nowrap compact" style="width:100%">
              <thead>
                  <tr>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Email</th>
                      
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <td>{{ $log->users->name }}</td>
                    <td>{{ $log->users->nik }}</td>
                    <td>{{ $log->users->email }}</td>
                    
                  </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Email</th>
                  
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
