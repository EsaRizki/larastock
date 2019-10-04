@if (Auth::user()->role->id == 1)
@foreach ($transaksi as $log)
<tr>
    @if(isset($log->suratJalan->no_surat))
        <td>{{ $log->suratJalan->no_surat }}</td> 
        @else
        <td>-</td>
    @endif
    <td><a href="#myModal" id="openBtn" data-toggle="modal" data-target="{{ '#' . $log->id . 'pengguna' }}">
        {{ $log->users->name }}
        </a>
        @include('transaksi.detail_pengguna', ['object' => $log])
    </td>
    <td>
        <a href="#myModal" id="openBtn" data-toggle="modal" data-target="{{ '#' . $log->id . 'barang' }}">{{ $log->carts->count() }} jenis barang</a>
        @include('transaksi.detail_barang', ['object' => $log])
    </td>
    @if($log->status == 0)
        <td>Menunggu</td>
        @elseif($log->status == 1)
        <td>Sedang diproses</td>
        @elseif($log->status == 2)
        <td>Selesai</td>
    @endif
    <td>
        {{ $log->carts->sum('qty') }} barang
    </td>
    <td>{{ $log->created_at }}</td>
    <td>
        <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="{{ '#' . $log->id . 'pengirim' }}"><span class="glyphicon glyphicon-refresh" aria-hidden="true" data-toggle="tooltip" title="Proses"></span></a>
        @include('transaksi.pengirim', ['object' => $log])

        @if(isset($log->suratJalan->no_surat))
        <a class="btn btn-primary btn-xs" href="{{ route('transaksi.show', $log->id) }}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" data-toggle="tooltip" title="Lihat"></span></a>
        <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="{{ '#' . $log->id . 'konfirmasi' }}"><span class="glyphicon glyphicon-ok" aria-hidden="true" data-toggle="tooltip" title="Konfirmasi"></span></a>
        @include('transaksi.konfirmasi', ['object' => $log])
        @else
        <a class="btn btn-primary btn-xs disabled" href="{{ route('transaksi.show', $log->id) }}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" data-toggle="tooltip" title="Lihat"></span></a>
        <a class="btn btn-primary btn-xs disabled" href="#" data-toggle="modal" data-target="{{ '#' . $log->id . 'konfirmasi' }}"><span class="glyphicon glyphicon-ok" aria-hidden="true" data-toggle="tooltip" title="Konfirmasi"></span></a>
        
        @endif
        
        
    </td>
</tr>
@endforeach
@endif