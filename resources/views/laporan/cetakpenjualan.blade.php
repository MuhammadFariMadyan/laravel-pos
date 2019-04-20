<?php 
  function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
  }
 ?>
@extends('vendor.cetak')

@section('judul')
Laporan Penjualan
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
      <th class="text-center">No.</th>
      <th class="text-center">Tanggal</th>
      <th class="text-center">No. Penjualan</th>
      <th class="text-center">Nama Barang</th>
      <th class="text-center">Harga (Rp)</th>  
      <th class="text-center">Jumlah</th>                                    
      <th class="text-center">Total (Rp)</th>                      
    </thead>                                    
    <tbody>
    @php
      $i=1;
    @endphp
    @foreach ($laps as $penjualan)
    <tr>
      <td width="5%" class="text-center">{{$i++}}</td>
      <td width="20%" class="text-center">{{date("d F Y",strtotime($penjualan->tanggal))}}</td>                    
      <td class="text-center">{{$penjualan->kode_penjualan}}</td>
      <td >{{$penjualan->nama_barang}}</td>
      <td style="text-align: center;" width="15%">{{rupiah($penjualan->harga_jual_akhir)}}</td>
      <td width="5%" class="text-center">{{$penjualan->jumlah_jual}}</td>
      <td style="text-align: center;" width="15%">{{rupiah($penjualan->sub_total_harga)}}</td>                    
    </tr>
  @endforeach
  </tbody>
  </table>  
  <table class="table table-bordered">
    <td width="25%" style="text-align: center;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Penjualan</strong></td>
    <td style="text-align: center;"></td>
    <td width="15%" style="text-align: center;">{{rupiah($harga_total)}}</td>    
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
