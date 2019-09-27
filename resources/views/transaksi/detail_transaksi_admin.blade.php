@if (Auth::user()->role->id == 1)
@foreach ($transaksi as $log)
<tr>
    <td>SKJ/AJ-LS/{{ $log->id }}</td>   
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
    @endif
    <td>{{ $log->keterangan }}</td>
    <td>
        {{ $log->carts->sum('qty') }} barang
    </td>
    <td>{{ $log->created_at }}</td>
    <td>
        <a class="btn btn-primary btn-xs" href="{{ route('transaksi.show', $log->id) }}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" data-toggle="tooltip" title="Lihat"></span></a>
        <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="{{ '#' . $log->id . 'pengirim' }}"><span class="glyphicon glyphicon-refresh" aria-hidden="true" data-toggle="tooltip" title="Proses"></span></a>
        @include('transaksi.pengirim', ['object' => $log])
    </td>
</tr>
@endforeach
@endif