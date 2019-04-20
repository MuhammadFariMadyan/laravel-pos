@extends('light-bootstrap-dashboard::layouts.main')


@section('sidebar-menu')
  <ul class="nav">
    @if (auth()->check())
{{-- <li class="{{Request::path() == 'pemilik' ? 'active' : ''}}">
  <a href="{{route('pemilikdash')}}">
    <i class="pe-7s-graph"></i>
    <p>Dashboard Admin</p>
  </a>
</li> --}}
@if(Auth::user()->hasRole('penjaga'))
<li class=
@if (Request::is('penjaga/barang') || Request::is('penjaga/barang/*'))
'active'
@endif
>
  <a href="{{route('databarang')}}">
    <i class="pe-7s-server"></i>
    <p>Data Barang</p>
  </a>
</li>
@endif
@if(Auth::user()->hasRole('penjaga'))
<li class=
@if (Request::is('penjaga/barang_kategori') || Request::is('penjaga/barang_kategori/*'))
'active'
@endif
>
  <a href="{{route('databarang_kategori')}}">
    <i class="pe-7s-server"></i>
    <p>Kategori Barang</p>
  </a>
</li>
@endif
@if(Auth::user()->hasRole('penjaga'))
<li class=
@if (Request::is('penjaga/barang_satuan') || Request::is('penjaga/barang_satuan/*'))
'active'
@endif
>
  <a href="{{route('databarang_satuan')}}">
    <i class="pe-7s-server"></i>
    <p>Satuan Barang</p>
  </a>
</li>
@endif
@role('pemilik')
<li class=
@if (Request::is('pemilik/supplier*') || Request::is('penjaga/supplier*'))
'active'
@endif
>
  <a href="
    {{(Auth::user()->hasRole('penjaga')) ? route('datasupplier') : route('datasupplierpm')}}">
    <i class="pe-7s-users"></i>
    <p>Data Suplier</p>
  </a>
</li>
<li class=@if (Request::is('pemilik/penjaga*'))
'active'
@endif
>
<a href={{route('datapenjaga')}}>
    <i class="pe-7s-user"></i>
    <p>Data Penjaga</p></a>
</li>
@endrole
<hr>
@if(Auth::user()->hasRole('penjaga'))
<p>Transaksi</p>
<li class=
@if (Request::is('penjaga/penjualan') || Request::is('penjaga/penjualan/*'))
'active'
@endif
>
  <a href="{{route('tambahpenjualan')}}">
    <i class="pe-7s-way"></i>
    <p>Penjualan</p>
  </a>
</li>
<li class=
@if (Request::is('penjaga/pembelian') || Request::is('penjaga/pembelian/*'))
'active'
@endif
>
  <a href="{{route('tambahpembelian')}}">
    <i class="pe-7s-wallet"></i>
    <p>Pembelian</p>
  </a>
</li>
<hr>
@endif
<p>Laporan</p>
<li class=
@if (Request::is('pemilik/laporan/penjualan') || Request::is('pemilik/laporan/penjualan*') || Request::is('penjaga/laporan/penjualan') || Request::is('penjaga/laporan/penjualan*'))
'active'
@endif>
    <a href=
    {{(Auth::user()->hasRole('penjaga')) ? route('laporanpenjualan') : route('laporanpenjualanpm')}}>
    <i class="pe-7s-ticket"></i>
    <p>Penjualan</p>
  </a>
</li>
<li class=
@if (Request::is('penjaga/laporan/persediaan') || Request::is('penjaga/laporan/persediaan*') || Request::is('pemilik/laporan/persediaan') || Request::is('pemilik/laporan/persediaan*'))
'active'
@endif>
  <a href=
  {{(Auth::user()->hasRole('penjaga')) ? route('laporanpersediaan') : route('laporanpersediaanpm')}}>
    <i class="pe-7s-piggy"></i>
    <p>Persediaan</p>
  </a>
</li>
<li class=
@if (Request::is('penjaga/laporan/kas') || Request::is('penjaga/laporan/kas/*') || Request::is('pemilik/laporan/kas') || Request::is('pemilik/laporan/kas/*'))
'active'
@endif>
  <a href={{(Auth::user()->hasRole('penjaga')) ? route('datakas') : route('datakaspm')}}>
    <i class="pe-7s-cash"></i>
    <p>Penerimaan Kas</p>
  </a>
</li >
<hr>
<li class=
@if (Request::is('grafik') || Request::is('grafik/*'))
'active'
@endif>
  <a href="{{route('grafikpenjualan')}}">
    <i class="pe-7s-graph"></i>
    <p>Grafik Penjualan</p>
  </a>
</li>
@else
<li><a href="{{route('login')}}">
  <i class="pe-7s-key"></i>
  <p>Login</p>
</a></li>
@endif
</ul>
@endsection
