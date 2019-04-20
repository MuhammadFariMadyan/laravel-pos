@extends('vendor.nota')

@section('judul')
Nota Pembelian
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
      <th>Nomor</th>
      <th>Tanggal</th>
      <th>Nota</th>
      <th>Nama supplier</th>
      <th>nama barang</th>
      <th>harga beli</th>
      <th>jumlah</th>
      <th>total</th>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>{{$pembelian->tanggal}}</td>
        <td>{{$pembelian->kode_struk}}</td>
        <td>{{$pembelian->nama_supplier}}</td>
        <td>{{$pembelian->nama_barang}}</td>
        <td>{{$pembelian->harga_beli}}</td>
        <td>{{$pembelian->jumlah}}</td>
        <td>{{$pembelian->total}}</td>
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
