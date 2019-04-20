@extends('vendor.cetak')

@section('judul')
Laporan Pembelian
@endsection

@section('print')
  <table>
    <tr>
      <td><h3>Nama Penjaga</h3></td>
      <td><h3>&nbsp;: {{Auth::user()->name}}</h3></td>
    </tr>
    <tr>
      <td><h3>Periode</h3></td>
      <td><h3>&nbsp;: {{date("d F Y",strtotime($awal))}} <strong>Sampai</strong> {{date("d F Y",strtotime($akhir))}} </h3></td>
    </tr>
  </table>
  @php
    $i=1;
  @endphp
  <table class="table table-bordered" width="100%">
    <thead>
      <th style="text-align: center;">Nomor</th>
      <th style="text-align: center;">Tanggal</th>
      <th style="text-align: center;">Kode Pembelian</th>      
      <th style="text-align: center;">Nama Supplier</th>                                      
      <th style="text-align: center;">Total Harga</th>
      <!-- <th style="text-align: center;">Jumlah Bayar</th>
      <th style="text-align: center;">Kembalian</th> -->
    </thead>
    <tbody>
      @foreach ($pembelians as $pembelian)
      <tr>
        <td style="text-align: center;">{{$i++}}</td>
        <td style="text-align: center;">{{date("d F Y",strtotime($pembelian->tanggal))}}</td>
        <td style="text-align: center;">{{$pembelian->kode_pembelian}}</td>        
        <td >{{$pembelian->nama_supplier}}</td>
        <td style="text-align: right;">Rp. {{$pembelian->total_harga_beli}}</td>
        <!-- <td style="text-align: right;">Rp. $pembelian->total_bayar</td>
        <td style="text-align: right;">Rp. $pembelian->total_kembalian</td> -->
      </tr>
    @endforeach
    </tbody>
  </table>
  <table class="table table-bordered">
    <td>Total</td>
    <td width="20%" style="text-align: right;">Rp.&nbsp; {{number_format($total,0,',','.')}}</td>
  </table>
  <br>
  <h3><span class="pull-right">Disetujui Oleh</span></h3>
  <h3><span class="pull-left">Diterima Oleh</span></h3>
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
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
@endsection
