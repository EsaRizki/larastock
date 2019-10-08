<thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Stok Awal</th>
                                    <th>Kondisi</th>
                                    <th>Keterangan</th>
                                    <th>Sisa</th>
                                    <th>Tanggal Input</th>
                                    <th>Tertanda</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($barang as $log)
                                
                                    <tr>   
                                        <td>
                                            {{ $log->nama }}<a href="#myModal" id="openBtn" data-toggle="modal" data-target="{{ '#' . $log->id . 'modal' }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
                                            @include('barang.detail_barang', ['object' => $log])
                                        </td>
                                        <td>{{ $log->lokasi->nama }}</td>
                                        <td>{{ $log->stoks->first()->qty }}</td>
                                        <td>
                                        @if($log->kondisi == 0)
                                        Baru
                                        @elseif($log->kondisi == 1)
                                        Bekas
                                        @elseif($log->kondisi == 2)
                                        Rusak
                                        @endif
                                        </td>
                                        <td>{{ $log->keterangan }}</td>
                                        
                                        <td>{{ $log->stoks->sum('qty') }}</td>
                                        <td>{{ $log->created_at }}</td>
                                        <td>{{ $log->user->name }}</td>
                                    
                                        <td>@include('barang.action')</td>
                                        @include('partials.qrcode', ['object' => $log])
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Stok Awal</th>
                                    <th>Kondisi</th>
                                    <th>Keterangan</th>
                                    <th>Sisa</th>
                                    <th>Tanggal Input</th>
                                    <th>Tertanda</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>