<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="Aplikasi Keuangan Badan usaha milik Ohoi (Bumo) kabupaten maluku tenggara">
<meta itemprop="description" content="Aplikasi Keuangan Badan usaha milik Ohoi (Bumo) kabupaten maluku tenggara">
<title>@yield('title')</title>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify-icons.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dist/css/dropify.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/selectize.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/selectize.default.css') }}"> --}}

<script src="{{ asset('assets/js/jquery-2.1.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('assets/js/fill.box.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/dropify.min.js') }}"></script>
<script src="{{ asset('assets/js/switchery.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{ asset('js/selectize.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
        border: 1px solid #2DC716;
        background-color :#2DC716;;
    }
</style>

</head>

<body>

<div id="main">
	
    <header class="main-header">
    	<div class="topbar-header">
        	<div class="container-fluid">
            	<a class="logo" href="#!">Quick</a>
                <h5 class="app-title">Quick Count Application</h5>
                <div class="topbar-right">
                	<ul class="topbar-menu">
                    	<li>
                        	<div class="user-menu">
                                <a href="#!" data-toggle="dropdown">
                                    <span class="user-avatar">
                                        <div class="thumb">
                                            <img src="{{ asset('assets/images/avatar_profile.png') }}">
                                        </div>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <div class="dropdown-heading">
                                            <h5 class="user-name">{{ Auth::user()->name }}</h5>
                                            <div class="user-type">{{ Auth::user()->level }}</div>
                                        </div>
                                    </li>
                                    <li><a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @if(Auth::user()->level == "admin")
        <nav class="header-nav">
        	<div class="container-fluid">
            	<div class="header-menu">
                	<ul class="menu">
                    	<li class=""><a href="{{ url('admin/dashboard') }}"><span class="icon icon-layers"></span>Dashboard</a></li>
                        <li class=""><a href="{{ route('pemilu_setting.index') }}"><span class="icon icon-layers"></span>Setting Wilayah</a></li>
                        <li><a>Caleg</a>
                            <ul class="dropdown-hover">
                                <li><a href="{{ route('caleg.index') }}">Caleg</a></li>
                                <li><a href="{{ route('type_candidates.index') }}">Tipe Caleg</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('partai.index') }}"><span class="icon icon-layers"></span>Partai</a></li>
                        <li><a href="{{ url('admin/relawan') }}"><span class="icon icon-layers"></span>Relawan</a></li>
                        <li><a href="{{ route('tps.index') }}"><span class="icon icon-layers"></span>TPS</a></li>
                        <li><a>Wilayah</a>
                        	<ul class="dropdown-hover">
                            	<li><a href="{{ route('province.index') }}">Provinsi</a></li>
                                <li><a href="{{ route('kokab.index') }}">Kabupaten & Kota</a></li>
                                <li><a href="{{ route('kecamatan.index') }}">Kecamatan</a></li>
                                <li><a href="{{ route('kelurahan.index') }}">Kelurahan</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('transaction/result') }}"><span class="icon icon-layers"></span>Perolehan Suara</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        @else 
        <nav class="header-nav">
            <div class="container-fluid">
                <div class="header-menu">
                    <ul class="menu">
                        <li class=""><a href="{{ route('pemilu_setting.index') }}"><span class="icon icon-layers"></span>Pemilu</a></li>
                        <li><a href="{{ route('partai.index') }}"><span class="icon icon-layers"></span>Transaksi</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        @endif
    </header>
    
    <section class="page-content">
    
    	<section class="bg-title">
        	<div class="container-fluid">
            	<h5 class="page-title">@yield('page_name')</h5>
                <ul class="breadcrumb">
                	@yield('breadcrumb')
                </ul>
            </div>
        </section>
        
        <section class="main-page--content">
        	<div class="container-fluid">
                @yield('content')
            </div>
        </section>
        
    </section>
    
    <footer class="main-footer">
    	<div class="container-fluid">
        	<span class="copyright">
        		© 2018 Quick Count Application
            </span>
            <ul class="footer-nav">
            	<li><a href="#!">Contact Us</a></li>
                <li><a href="#!">Terms</a></li>
                <li><a href="#!">Privacy</a></li>
            </ul>
        </div>
    </footer>
    
</div>
@include('component.alert')
<script>
	
	$('.thumb img').fillBox();
	
	$('.main-header .header-nav').sticky({topSpacing:0});
	
    $(document).ready(function(){
        $('#select2').select2();
        $('.dropify').dropify();
        $('.dropify2').dropify();
        $('#myTable').DataTable();
        $('.selectize').selectize();
        $('.selectize2').selectize();

        var table = $('#example').DataTable({
            "columnDefs": [{"visible": false, "targets": 2 }],
            "order": [[ 2, 'asc' ]],
            "displayLength": 25,
            "drawCallback": function ( settings ) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;
                api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        $(rows).eq( i ).before('<tr class="group"><td colspan="5">'+group+'</td></tr>');
                    last = group;
                    }
                });
            }
        });
            // ORDER BT GROUPING
            $('#example tbody').on( 'click', 'tr.group', function () {
                var currentOrder = table.order()[0];
                if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
                    table.order( [ 2, 'desc' ] ).draw();
                } else {
                    table.order( [ 2, 'asc' ] ).draw();
                }
            });
                $('#example2').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    

</script>

</body>
</html>
