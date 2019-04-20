<?php 
  function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
  }
 ?>
@extends('layouts.app')

@section('content-title', 'Laporan Penjualan')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">Laporan Penjualan</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Laporan Penjualan<span class="pull-right"><a target="_blank" href={{Auth::user()->hasRole('penjaga') ? route('cetaktlaporanpenjualan',['awal'=>$awal,'akhir'=>$akhir]) : route('cetaktlaporanpenjualanpm',['awal'=>$awal,'akhir'=>$akhir])}} class="btn btn-xs btn-fill btn-success"><i class="fa fa-print"></i>Cetak</a></span></h4>
            </div>
            <div class="content table-responsive table-full-width">
              <div class="col-md-12">
                <form class="form-inline" action={{Auth::user()->hasRole('penjaga') ? route('lihatlaporanpenjualan') : route('lihatlaporanpenjualanpm')}}>
                  <div class="form-group">
                    <label for="">Tanggal&nbsp;:&nbsp;</label>
                    <input type="date" class="form-control input-sm" id="tanggalawal" name="tanggalawal" value="{{$awal}}">
                  </div>
                  <i class="fa fa-arrows-h fa-lg"></i>
                  <div class="form-group">
                    <input type="date" class="form-control input-sm" id="tanggalakhir" name="tanggalakhir" value="{{$akhir}}">
                  </div>&nbsp;
                  <button type="submit" class="btn btn-success btn-fill btn-sm">Tampilkan</button>
                </form>
              </div>
                {{-- {!! $html->table(['class'=>'table table-striped table-hover'])!!} --}}
                <table class="table table-striped table-hover">
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
                    <td class="text-center">{{$i++}}</td>
                    <td class="text-center">{{date("d F Y",strtotime($penjualan->tanggal))}}</td>                    
                    <td class="text-center">{{$penjualan->kode_penjualan}}</td>
                    <td >{{$penjualan->nama_barang}}</td>
                    <td>{{rupiah($penjualan->harga_jual_akhir)}}</td>
                    <td class="text-center">{{$penjualan->jumlah_jual}}</td>
                    <td>{{rupiah($penjualan->sub_total_harga)}}</td>                    
                  </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="header">
          <h4 class="title">Total</h4>
          <p class="category">Jumlah keseluruhan dari data diatas:</p>
        </div>
        <div class="content">
          <table>
            <tr>
              <td>Total Penjualan :&nbsp;</td>
              <td><b>{{rupiah($harga_total)}}</b></td> 
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
