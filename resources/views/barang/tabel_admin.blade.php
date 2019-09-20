<thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Kondisi</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Sisa</th>
                                    <th>Satuan</th>
                                    <th>Tanggal Input</th>
                                    <th>Tertanda</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($barang as $log)
                                
                                {{-- @php
                                        $transaksi = $log->carts->where('status', 1);
                                        $sisa = $log->jumlah - $transaksi->sum('qty');
                                @endphp
                                @if ($sisa != 0) --}}
                                    <tr>   
                                        <td>
                                            {{ $log->nama }}<a href="#myModal" id="openBtn" data-toggle="modal" data-target="{{ '#' . $log->id . 'modal' }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
                                            @include('barang.detail_barang', ['object' => $log])
                                        </td>
                                        <td>{{ $log->lokasi->nama }}</td>
                                        {{-- <td>{{ $log->stoks->first()->qty }}</td> --}}
                                        <td>
                                        @if($log->kondisi == 0)
                                        Baru
                                        @elseif($log->kondisi == 1)
                                        Bekas
                                        @elseif($log->kondisi == 2)
                                        Rusak
                                        @endif
                                        </td>
                                        <td><a href="{{ route('harga.jual', $log->id) }}">{{ $log->harga }}</a></td>
                                        <td>{{ $log->keterangan }}</td>
                                        
                                        <td><a href="{{ route('stok.index', $log->id) }}">{{ $log->stoks->sum('qty') }}</a></td>
                                        <td>{{ $log->satuan->nama }}</td>
                                        <td>{{ $log->created_at }}</td>
                                        <td>{{ $log->user->name }}</td>
                                    
                                        <td>@include('barang.action')</td>
                                        @include('partials.qrcode', ['object' => $log])
                                    </tr>
                                {{-- @endif --}}
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Kondisi</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Sisa</th>
                                    <th>Satuan</th>
                                    <th>Tanggal Input</th>
                                    <th>Tertanda</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>