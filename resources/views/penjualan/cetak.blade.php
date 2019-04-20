@extends('vendor.cetak')

@section('judul')
Transaksi Penjualan
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
  @php
    $i=1;
  @endphp
  <table class="table table-bordered text-uppercase" width="100%">
    <thead>
      <th class="text-center">Nomor</th>
      <th class="text-center">No. Penjualan</th>
      <th class="text-center">Nama Penjaga</th>
      <th class="text-center">Tanggal</th>
      <th class="text-center">Total Harga Jual</th>
      <th class="text-center">Jumlah bayar</th>
      <th class="text-center">Kembalian</th>      
    </thead>
    <tbody>
      @php
        $i=1;
      @endphp
      @foreach ($penjualans as $penjualan)
      <tr>
        <td class="text-center">{{$i++}}</td>
        <td class="text-center">{{$penjualan->kode_penjualan}}</td>
        <td class="text-center">{{$penjualan->createdby}}</td>
        <td class="text-center">{{$penjualan->tanggal}}</td>
        <td class="text-center">Rp. {{$penjualan->total_harga_jual}}</td>
        <td class="text-center">Rp. {{$penjualan->total_bayar}}</td> 
        <td class="text-center">Rp. {{$penjualan->total_kembalian}}</td>      
      </tr>
    @endforeach
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
