@extends('vendor.nota')

@section('judul')
Nota Penjualan
@endsection

@section('print')
  <table>
    <tr>
      <td><h3>Nama Penjaga</h3></td>
      <td><h3>&nbsp;: {{Auth::user()->name}}</h3></td>
    </tr>
    <tr>
      <td><h3>Tanggal</h3></td>
      <td><h3 id="tanggal">&nbsp;: </h3></td>
    </tr>
  </table>
  <table class="table table-bordered text-uppercase" width="100%">
    <thead>
      <td><h3>tanggal</h3></td>
      <td><h3>kode struk</h3></td>
      <td><h3>Nama Supplier</h3></td>
      <td><h3>Nama Barang</h3></td>
      <td><h3>Harga beli</h3></td>
      <td><h3>Diskon</h3></td>
      <td><h3>Jumlah</h3></td>
      <td><h3>TOTAL</h3></td>
    </thead>
    <tbody>
    <tr>
      <td><h3>{{$penjualan->tanggal}}</h3></td>
      <td><h3>{{$penjualan->kode_penjualan}}</h3></td>
      <td><h3>{{$penjualan->nama_barang}}</h3></td>
      <td><h3>{{$penjualan->nama_penjaga}}</h3></td>
      <td><h3>{{$penjualan->harga_jual}}</h3></td>
      <td><h3>{{$penjualan->diskon}}%</h3></td>
      <td><h3>{{$penjualan->jumlah}}</h3></td>
      <td><h3>{{$penjualan->total}}</h3></td>
    </tr>
  </tbody>
  </table>
  <br>
  <h3><span class="pull-right">Tanda Tangan Pemilik</span></h3>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

@endsection
