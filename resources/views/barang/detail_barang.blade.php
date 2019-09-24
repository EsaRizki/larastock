<div id="{{ $log->id . 'modal' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail {{ $log->nama }}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <center>  
              @if (isset($log) && $log->foto)
                <img class="img-rounded img-responsive " style="width: 30rem; height: 30rem" src="{!!asset('img/'.$log->foto)!!}">
              @else
                 Foto belum di upload
              @endif
            <div class="row">
                Lokasi : {{ $log->lokasi->nama }}
            </div>
            
            <div class="row">
              @php
                  $transaksi = $log->carts->where('status', 1);
                  $sisa = $log->jumlah - $transaksi->sum('qty'); 
              @endphp
                Sisa : {{ $log->stoks->sum('qty') }}
            </div>
            <div class="row">
              <a href="{{ route('barang.transaksi', $log->id) }}">{{ $log->carts->where('status', 1)->count() }} transaksi</a>
            </div>
          </center>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>