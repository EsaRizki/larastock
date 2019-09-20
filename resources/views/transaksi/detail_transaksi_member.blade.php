@foreach ($transaksi as $log)
@if (Auth::id() == $log->user_id)
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
    
    <td>{{ $log->keterangan }}</td>
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