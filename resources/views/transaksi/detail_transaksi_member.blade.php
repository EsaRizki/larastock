@foreach ($transaksi as $log)
@if (Auth::user()->role->id != 1)
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
    
    <td>
        {{ $log->carts->sum('qty') }} barang
    </td>
    <td>{{ $log->created_at }}</td>
    <td>
        <a href="{{ route('transaksi.show', $log->id) }}" class="btn btn-primary">
        Lihat
        </a>
    </td>
</tr>
@endif
@endforeach