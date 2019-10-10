@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Stock Opname</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Daftar Stock Opname</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                  <p><a class="btn btn-primary" href="#myModal" id="openBtn" data-toggle="modal" data-target="{{ '#' . 'modal' }}"><i class="glyphicon glyphicon-retweet"></i> SO <span class="badge">@if (count($badge) != 0)
                        {{ $badge->count() }}
                    @endif</span></a></p>
                  @include('so.modal')
                   <div class="table-responsive">
                        <table id="example">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Gudang</th>
                                    <th>Lokasi</th>
                                    <th>Sisa</th>
                                    <th>Tertanda</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barang as $log)
                                @if( $log->updated_at->format('d-m-Y') != \Carbon\Carbon::today()->format('d-m-Y') )
                                    <tr>
                                        <td>{{ $log->nama }}</td>
                                        <td>{{ $log->lokasi->parent->nama }}</td>
                                        <td>{{ $log->lokasi->nama }}</td>
                                        <td>{{ $log->stoks->sum('qty') }}</td>
                                        <td>{{ $log->stoks->first()->user->name }}</td>
                                        <td>@include('so.action')</td>
                                    </tr>
                                    @elseif ($log->updated_at->format('d-m-Y') == \Carbon\Carbon::today()->format('d-m-Y') && $log->status != 3 )
                                        <tr>
                                        <td>{{ $log->nama }}</td>
                                        <td>{{ $log->lokasi->parent->nama }}</td>
                                        <td>{{ $log->lokasi->nama }}</td>
                                        <td>{{ $log->stoks->sum('qty') }}</td>
                                        <td>{{ $log->stoks->first()->user->name }}</td>
                                        <td>@include('so.action')</td>
                                    </tr>
                                    @endif   
                                @endforeach
                            </tbody>
                            <tfoot>
                                    <th>Nama</th>
                                    <th>Gudang</th>
                                    <th>Lokasi</th>
                                    <th>Sisa</th>
                                    <th>Tertanda</th>
                                    <th>Aksi</th> 
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
@stop
