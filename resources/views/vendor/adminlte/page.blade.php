@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop
 
@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')

    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>

                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle fa5" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li>
                            <a href="">
                                {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li>

                            
                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                            @else

                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">

                    {{-- <div style="margin-left: 20px">
                    <i class="fa fa-user"></i>
                    <span style="color: silver" class="pull-right-container">{{ Auth::user()->name }}</span></div> --}}

                    {{-- @each('adminlte::partials.menu-item', $adminlte->menu(), 'item') --}}

                    {{-- Navigasi Manual --}}
                    <li class="header">Main Navigation</li>
                    @if (Auth::user()->role_id == 1)
                     <li><a href="{{ route('user.index') }}"><i class='fa fa-users'></i><span>{{ trans('Pengguna') }}</span></a></li>
                     <li class="treeview">
                        <a href="#"><i class='fa fa-home'></i><span>{{ trans('Gedung') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('gedung.index') }}"><i class='fa fa-university'></i> <span>{{ trans('Gedung') }}</span></a></li>
                            <li><a href="{{ route('gudang.index') }}"><i class='fa fa-home'></i> <span>{{ trans('Gudang') }}</span></a></li>
                            <li><a href="{{ route('lokasi.index') }}"><i class='fa fa-map'></i> <span>{{ trans('Lokasi') }}</span></a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class='fa fa-cubes'></i><span>{{ trans('Barang') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('kategori.index') }}"><i class='fa fa-list-alt'></i><span>{{ trans('Kategori') }}</span></a></li>
                            <li><a href="#"><i class='fa fa-balance-scale'></i><span>{{ trans('Satuan') }}</span></a></li>
                            <li><a href="{{ route('barang.index') }}"><i class='fa fa-cubes'></i><span>{{ trans('Barang') }}</span></a></li>
                            <li><a href="{{ route('barang.habis') }}"><i class='fa fa-archive'></i><span> {{ trans('Habis') }}</span></a></li>
                        </ul>
                    </li>
                    @php
                        $transaksi = \App\Transaksi::where('status', 0)->count();
                    @endphp
                    <li class="treeview">
                        <a href="#"><i class='fa fa-car'></i> <span> {{ trans('Transaksi') }} </span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('transaksi.index') }}"><i class='fa fa-car'></i><span>{{ trans('Transaksi') }}</span> <span class="badge">{{ $transaksi }}</span></a></li>
                            {{-- <li><a href="#"><i class='fa fa-trash'></i> <span>{{ trans('Pemusnahan') }}</span></a></li> --}}
                        </ul>
                    </li>
                    @endif
                    @if (Auth::user()->role_id == 2)
                     <li><a href="{{ route('barang.index') }}"><i class='fa fa-cubes'></i><span>{{ trans('Barang') }}</span></a></li>
                    
                    <li><a href="{{ route('transaksi.index') }}"><i class='fas fa-shipping-fast'></i><span> {{ trans('Transaksi') }}</span></a></li>
                    @endif

                    
                    
                    <li class="header">Account Setting</li>
                    <li><a href="{{ route('user.profile', Auth::id()) }}"><i class='fas fa-fw fa-user'></i> <span>{{ trans('Profile') }}</span></a></li>
                     {{-- <li><a href="#"><i class='fas fa-fw fa-lock'></i> <span>{{ trans('Ubah Password') }}</span></a></li>
                      --}}   

                      <li>      
                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                            @else

                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    <i class="fa fa-fw fa-power-off"></i> <span>{{ trans('adminlte::adminlte.log_out') }}</span> 
                                </a>
                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </li>
                        {{-- Navigasi Manual --}}
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">
                @include('layouts._flash')
                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

        @hasSection('footer')
        
        @endif
        <footer class="main-footer ">
            @yield('footer')
            <div class="pull-right hidden-xs">
              الحقير والفقير إلى رحمة ربه  <a target="_blank" href="#">            أبو جلال الإنجلي   </a>

            </div>
            {{ trans('Dikembangkan oleh') }} <a target="_blank" href="#">Esa Rizki Hari Utama</a>
        </footer>
    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script>
            /** add active class and stay opened when selected */
var url = window.location;

// for sidebar menu entirely but not cover treeview
$('ul.sidebar-menu a').filter(function() {
    return this.href == url;
}).parent().siblings().removeClass('active').end().addClass('active');

// for treeview
$('ul.treeview-menu a').filter(function() {
    return this.href == url;
}).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active').end().addClass('active');
    </script>
    @stack('js')
    @yield('js')
@stop
