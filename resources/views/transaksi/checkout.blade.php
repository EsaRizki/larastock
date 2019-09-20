{{-- <form method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
                        @csrf
                        <p>
                            <button type="submit" class="btn btn-primary">
                                    {{ __('Ambil') }}
                                </button>
                        </p>
</form>
 --}}

 <div id="{{ 'checkout' . 'modal' }}" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Detail </h4>
                              </div>
                              <div class="modal-body">
                                {{-- <div class="row">
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
                                        Sisa : {{ $log->jumlah }}
                                    </div>
                                  </center>
                                </div> --}}
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>