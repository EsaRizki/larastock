<thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Barang</th>
                                    <th>Sisa</th>
                                    <th>Keterangan</th>
                                    <th>Tertanda</th>
                                    <th>Jumlah Ambil</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($barang as $log)

                                {{-- @if ($log->stock != 0) --}}
                                    <tr>   
                                        <td>
                                            
                                            {{ $log->nama }}<a href="#myModal" id="openBtn" data-toggle="modal" data-target="{{ '#' . $log->id . 'modal' }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
                                            @include('barang.detail_barang', ['object' => $log])
                                        </td>
                                        <td>{{ $log->lokasi->nama }}</td>
                                        <td>{{ $log->stoks->sum('qty') }}</td>
                                        <td>{{ $log->keterangan }}</td>
                                        <td>{{ $log->user->name }}</td>
                                        <form method="POST" action="{{ route('cart.store') }}">
                                            {{ csrf_field() }}
                                        <td>

                                            <input type="number" name="qty" min="1" max="{{ $log->stoks->sum('qty') }}">
                                            @if ($errors->has('qty'))
                                            <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            {{ $errors->first('qty') }}
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="barang_id" value="{{ $log->id }}">
                                            
                                        <button type="submit" value="submit" class="btn btn-info btn-link btn-xs"><span class="fa fa-cart-plus" aria-hidden="true" data-toggle="tooltip" title="Tambah"></span> </button>
                                     <p id="demo"></p></td></form>
                                    </tr>
                                {{-- @endif --}}
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Barang</th>
                                    <th>Sisa</th>
                                    <th>Keterangan</th>
                                    <th>Tertanda</th>
                                    <th>Jumlah Ambil</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>