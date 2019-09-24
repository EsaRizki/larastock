@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Nilai Tiket {{ $barang->nama }}</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Daftar Nilai Tiket {{ $barang->nama }}</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>

                    </div>
                <div class="box-body">
                    <p><a class="btn btn-primary" href="{{ route('harga.create', $barang) }}">Tambah</a></p>
                   <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped display responsive nowrap compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Area</th>
                                    <th>Nilai Rumus</th>
                                    <th>Nilai Tiket</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                    $jatabek = ($barang->harga * 1.2)/30;
                                    $luarKota = ($barang->harga * 1.25)/30;
                                    $luarPulau = ($barang->harga * 1.5)/30;
                                @endphp
                                @foreach ($barang->areas as $log)
                                <tr>
                                    <td>{{ $log->nama }}</td>
                                    @if ($log->id == 1)
                                    <td>{{ $jatabek }}</td>
                                    @elseif ($log->id == 2)
                                    <td>{{ $luarKota }}</td>
                                    @elseif ($log->id == 3)
                                    <td>{{ $luarPulau }}</td>
                                    @endif
                                    <td>{{ $log->pivot->harga }}</td>
                                    <td>@include('harga.action')</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Area</th>
                                    <th>Nilai Rumus</th>
                                    <th>Nilai Tiket</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    
    <script> console.log('Hi!'); </script>
    <script>
    var openFile = function(event) {
    var input = event.target;

    var reader = new FileReader();
    reader.onload = function(){
      var dataURL = reader.result;
      var output = document.getElementById('output');
      output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
  };
</script>
{{-- <script>
    var $company2 = $('.gudang');
    var $location2 = $(".lokasi");

    $company2.select2().on('change', function() {
        $.ajax({
            url:"/lokasi/cari/" + $company2.val(),
            type:'GET',
            success:function(data) {
                console.log(data);
                $location2.empty();
                $.each(data, function(value, key) {
                    var data = {
                        id: value,
                        text: key
                    };
                                  

                    var newOption = new Option(data.text, data.id, false, true);
                    
                    $location2.append(newOption).trigger('change');

                    
                });
                $location2.select2(); 
            }
        });
    }).trigger('change');
</script> --}}
<script>
    var $barang = $('.barang_id');
    var $company2 = $('.area');
    var $location2 = $("#harga");

    $company2.select2().on('change', function() {

        $.ajax({
            url:"/harga/cari/" + $company2.val(), // if you say $(this) here it will refer to the ajax call not $('.company2')
            type:'GET',
            success:function(data) {
                $location2.empty();
                $.each(data, function(value, key) {
                    $location2.append($("#harga").attr("value", value).text(key)); // name refers to the objects value when you do you ->lists('name', 'id') in laravel
                }); //reload the list and select the first option
            }
        });
    }).trigger('change');
</script>
@stop
