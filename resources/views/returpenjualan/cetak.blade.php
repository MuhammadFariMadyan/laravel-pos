@extends('vendor.cetak')

@section('judul')
Retur Penjualan
@endsection

@section('print')
  @php
    $i=1;
  @endphp
  <table class="table table-bordered text-uppercase" width="100%">
    <thead>
      <th>Nomor</th>
      <th>No Retur</th>
      <th>Tanggal</th>
      <th>Nama Penjaga</th>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Jumlah</th>
      <th>Keterangan</th>
    </thead>
    <tbody>
      @php
        $i=1;
      @endphp
      @foreach ($returs as $retur)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$retur->no_retur}}</td>
        <td>{{$retur->tanggal}}</td>
        <td>{{$retur->nama_penjaga}}</td>
        <td>{{$retur->kode_barang}}</td>
        <td>{{$retur->nama_barang}}</td>
        <td>{{$retur->jumlah}}</td>
        <td>{{$retur->keterangan}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  <table class="table table-bordered text-uppercase">
    <td>Total</td>
    <td width="20%">{{$total}} Retur Penjualan</td>
  </table>
@endsection
