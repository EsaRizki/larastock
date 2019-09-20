<form id="deleteCart" method="POST" action="{{ route('cart.destroy', $e->id) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
       <a class="btn btn-primary btn-xs" href="{{ route('cart.edit', $e->id) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true" data-toggle="tooltip" title="Edit"></span></a>
    <button type="submit" form="deleteCart" class="btn btn-warning btn-link btn-xs" onclick="return confirm('Apakah anda serius?')" value="Delete"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="Hapus"></span> </button>
</form>