@extends('vendor.cetak')

@section('judul')
Laporan Kas
@endsection

@section('print')
  <table>
    <tr>
      <td><h3>Nama Penjaga</h3></td>
      <td><h3>&nbsp;: {{Auth::user()->name}}</h3></td>
    </tr>
    <tr>
      <td><h3>Tanggal</h3></td>
      <td><h3>&nbsp;: {{date("d F Y",strtotime($awal))}} <strong>Sampai</strong> {{date("d F Y",strtotime($akhir))}} </h3></td>
    </tr>
  </table>
  @php
    $i=1;
  @endphp
  <table class="table table-bordered" width="100%">
    <thead style="text-align: center;">
      <th style="text-align: center;">Nomor</th>
      <th style="text-align: center;">No. Transaksi</th>
      <th style="text-align: center;">Tanggal</th>
      <th style="text-align: center;">Keterangan</th>
      <th style="text-align: center;">Debit (Rp)</th>          
      <th style="text-align: center;">Kredit (Rp)</th>
      <th style="text-align: center;">Saldo (Rp)</th>
    </thead>
    <tbody align="center">
      @php
        $i=1;
      @endphp
      @foreach ($kases as $kas)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$kas->ref}}</td>
        <td>{{date("d F Y",strtotime($kas->tanggal))}}</td>
        <td>{{$kas->keterangan}}</td>
        <td width="15%">Rp. {{number_format($kas->debit,0,',','.')}}</td>
        <td width="15%">Rp. {{number_format($kas->kredit,0,',','.')}}</td>
        <td width="15%">Rp. {{number_format($kas->saldo,0,',','.')}}</td>                                       
      </tr>
      @endforeach
      </tbody>
  </table>

  <table class="table table-bordered">
    <td width="55%"><b>Total Debit</b></td>    
    <td width="15%" style="text-align: center;"><b>Rp. {{number_format($total_debit,0,',','.')}}</b></td>
    <td></td>    
  </table>
  <table class="table table-bordered">
    <td width="70%"><b>Total Kredit</b></td>
    <td width="15%" style="text-align: center;"><b>Rp. {{number_format($total_kredit,0,',','.')}}</b></td>
    <td></td>
  </table>  
  <table class="table table-bordered">
    <td><b>Saldo Kas</b></td>
    <td width="15%" style="text-align: center;"><b>Rp. {{number_format($kas_total,0,',','.')}}</b></td>
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
