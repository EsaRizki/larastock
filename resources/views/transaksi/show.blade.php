<!DOCTYPE html>
<html>
<head>
<title>Bukti Pengambilan Barang</title>
<style>
/* --------------------------------------------------------------
Hartija Css Print Framework
* Version: 1.0
-------------------------------------------------------------- */
body {
width:100% !important;
margin:0 !important;
padding:0 !important;
line-height: 1.45;
font-family: Garamond,"Times New Roman", serif;
color: #000;
background: none;
font-size: 14pt; }
/* Headings */
h1,h2,h3,h4,h5,h6 { page-break-after:avoid; }
h1{font-size:19pt;}
h2{font-size:17pt;}
h3{font-size:15pt;}
h4,h5,h6{font-size:14pt;}
p, h2, h3 { orphans: 3; widows: 3; }
code { font: 12pt Courier, monospace; }
blockquote { margin: 1.2em; padding: 1em; font-size: 12pt; }
hr { background-color: #ccc; }
/* Images */
img { float: left; margin: 1em 1.5em 1.5em 0; max-width: 100% !important; }
a img { border: none; }
/* Links */
a:link, a:visited { background: transparent; font-weight: 700; text-decoration: underline;col\
or:#333; }
a:link[href^="http://"]:after, a[href^="http://"]:visited:after { content: " (" attr(href) ")\
"; font-size: 90%; }
abbr[title]:after { content: " (" attr(title) ")"; }
/* Don't show linked images */
a[href^="http://"] {color:#000; }
a[href$=".jpg"]:after, a[href$=".jpeg"]:after, a[href$=".gif"]:after, a[href$=".png"]:after {\
content: " (" attr(href) ") "; display:none; }
/* Don't show links that are fragment identifiers, or use the `javascript:` pseudo protocol .\
. taken from html5boilerplate */
a[href^="#"]:after, a[href^="javascript:"]:after {content: "";}
/* Table */
table { margin: 1px; text-align:left; }
th { border-bottom: 1px solid #333; font-weight: bold; }
td { border-bottom: 1px solid #333; }
th,td { padding: 4px 10px 4px 0; }
tfoot { font-style: italic; }
caption { background: #fff; margin-bottom:2em; text-align:left; }
thead {display: table-header-group;}
img,tr {page-break-inside: avoid;}
.qr{
	position: absolute; bottom: 200; left: 0;
}
/* Hide various parts from the site
#header, #footer, #navigation, #rightSideBar, #leftSideBar
{display:none;}
*/
</style>
</head>
<body>
	<table width="100%" border="1" class="table-responsive">
		<tr>
			<td colspan="2"><h1><center>BUKTI PENGAMBILAN BARANG</center></h1></td>
		</tr>
		<tr style="text-align: left; font-weight: bold;" >
			<td width="50%" style="padding: 10px">{{ $transaksi->users->name }}</td>
			<td width="50%" style="padding: 10px">SKJ/AJ-LS/{{ $transaksi->id }}</td>
		</tr>
		<tr style="text-align: left; font-weight: bold;" >
			<td width="50%" style="padding: 10px">{{ $transaksi->users->nik }}</td>
			<td width="50%" style="padding: 10px">{{ $transaksi->created_at }}</td>
		</tr>
		<tr style="text-align: left; font-weight: bold; border-style: none" >
			<td height="50px" width="100%" style="padding: 10px" colspan="2"></td>
		</tr>
		<tr style="text-align: center; font-weight: bold;" >
			<td width="50%" style="padding: 10px">Nama Barang</td>
			<td width="50%" style="padding: 10px">Jumlah</td>
		</tr>
		@foreach ($transaksi->carts as $log)
		<tr style="text-align: left; font-weight: bold;" >
			<td width="50%" style="padding: 3px">{{ $log->barang->nama }}</td>
			<td width="50%" style="padding: 3px">{{ $log->qty }}</td>
		</tr>
		@endforeach
		<tr style="text-align: left; font-weight: bold;" >
			<td width="50%" height="28px" style="padding: 3px"></td>
			<td width="50%" height="28px" style="padding: 3px"></td>
		</tr>
		<tr style="text-align: left; font-weight: bold;" >
			<td width="50%" height="28px" style="padding: 3px"></td>
			<td width="50%" height="28px" style="padding: 3px"></td>
		</tr>
		<tr style="text-align: left; font-weight: bold;" >
			<td width="50%" height="28px" style="padding: 3px"></td>
			<td width="50%" height="28px" style="padding: 3px"></td>
		</tr>
		<tr style="text-align: left; font-weight: bold;" >
			<td height="250px" colspan="2" width="50%" style="padding: 3px; text-align: center; vertical-align: top">{{ $transaksi->keterangan }}</td>
		</tr>
		{{-- <tr style="text-align: center; font-weight: bold;">
			<td>Keamanan :@if ($pengaduan->keamanan == 1)
			 <img class="img-rounded img-responsive" style="width: 20px; height: 20px" src="https://res.cloudinary.com/esarizki15/image/upload/v1551260488/Check-PNG-Image.png">
			@endif</td>
			<td>Kerugian :@if ($pengaduan->kerugian == 1)
				 <img class="img-rounded img-responsive" style="width: 20px; height: 20px" src="https://res.cloudinary.com/esarizki15/image/upload/v1551260488/Check-PNG-Image.png">
			@endif</td>
		</tr>
		<tr style="font-weight: bold;">
			<td><center>Kondisi Sekarang</center></td>
			<td><center>Setelah Perbaikan</center></td>	
		</tr>
		<tr>
			@if (isset($pengaduan) && $pengaduan->foto)
			<td>
				<center>
                	<img class="img-rounded img-responsive" style="width: 300px; height: 300px" src="{{ $pengaduan->foto }}">
                </center>
		    @else
		         Foto belum di upload
		    @endif
			</td>

			@if ($pengaduan->duplikats->penanganans->pengajuans->last()->status->status == 1)
			<td>
				<center>
                	<img class="img-rounded img-responsive" style="width: 300px; height: 300px" src="{{ $pengaduan->duplikats->penanganans->pengajuans->last()->foto }}">
                </center>
			</td>				
			@endif
		</tr>
			<tr style="text-align: center; font-weight: bold">
				<td colspan="2">Kategori {{ $pengaduan->kategoris->nama }}</td>
			</tr>
			<tr>
				<td style="padding-left: 20px">Pelapor : {{ $pengaduan->users->name }}</td>
				<td style="padding-left: 20px">Petugas : {{ $pengaduan->duplikats->penanganans->users->name }}</td>
			</tr>
			<tr>
				<td style="padding-left: 20px;  text-align: left; vertical-align: top" width="50%" height="200px">Deskripsi : {{ $pengaduan->deskripsi }}</td>
				<td style="padding-left: 20px; text-align: left; vertical-align: top">Deskripsi : {{ $pengaduan->duplikats->penanganans->pengajuans->last()->deskripsi }}</td>
			</tr>
			<tr>
				<td style="text-align: center;">{{ $pengaduan->created_at }}</td>
				<td style="text-align: center;">{{ $pengaduan->duplikats->penanganans->pengajuans->last()->created_at }}</td>
			</tr>
			@if (!is_null($pengaduan->duplikats->nilai_id))

			<tr style="text-align: center;">
				<td colspan="2"><span style="font-size:300%;">{{ $pengaduan->duplikats->penilaian->nilai }}</span><img class="img-rounded img-responsive" style="width: 40px; height: 40px" src="https://res.cloudinary.com/esarizki15/image/upload/v1551259926/gold-star-png--new-calendar-template-site-7.png">

</td>	
			@endif
			</tr> --}}
	</table>
<div class="qr" style="">
@php
	QRCode::url(route('transaksi.show', $transaksi->id))->setSize(4)->svg();
@endphp
</div>
</body>
</html>