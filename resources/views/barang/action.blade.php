<form method="POST" action="{{ route('barang.destroy', $log->id) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
       <a class="btn btn-primary btn-xs" href="{{ route('barang.edit', $log->id) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true" data-toggle="tooltip" title="Edit"></span></a> <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="{{ '#' . $log->id . 'qr' . '-modal' }}"><span class="fa fa-qrcode" aria-hidden="true" data-toggle="tooltip" title="Generate QR Code"></span></a> <a class="btn btn-primary btn-xs" href="#myModal" id="openBtn" data-toggle="modal" data-target="{{ '#' . $log->id . 'tambahStok' }}"><span class="
glyphicon glyphicon-plus" aria-hidden="true" data-toggle="tooltip" title="Tambah Stok"></span></a>
{{-- <a class="btn btn-primary btn-xs" href="#"><span class="glyphicon glyphicon-refresh" aria-hidden="true" data-toggle="tooltip" title="Pindahkan ke daftar barang habis?"></span></a> <a class="btn btn-danger btn-xs" href="#"><span class="fa fa-ban" aria-hidden="true" data-toggle="tooltip" title="Musnahkan?"></span></a>  --}}
    <button type="submit" class="btn btn-warning btn-link btn-xs" onclick="return confirm('Apakah anda serius?')"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="Hapus"></span> </button>
</form>
@include('barang.tambahStok', ['object' => $log])