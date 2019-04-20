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
      <td><h3 id="tanggal">&nbsp;: </h3></td>
    </tr>
  </table>
  @php
    $i=1;
  @endphp
  <table class="table table-bordered text-uppercase" width="100%">
    <thead>
      <!-- <th style="width: 3px; text-align: center;">Nomor</th>
      <th>Tanggal</th>
      <th>Keterangan</th>
      <th>Ref</th>
      <th>Debit</th>          
      <th>Kredit</th>
      <th>Saldo</th>
 -->
      <tr >
          <th class="text-center vertical-center" rowspan="3" >Nomor</th>
          <th class="text-center vertical-center" rowspan="3" width="30%" data-sort="string">Tanggal</th>
          <th class="text-center vertical-center" rowspan="3" >Keterangan</th>
          <th class="text-center vertical-center" rowspan="3" >Ref</th>
          <th class="text-center vertical-center" colspan="2" >Debit</th>
          <th class="text-center vertical-center" colspan="4">Kredit</th>
      </tr>
      <tr >                    
          <th class="text-center vertical-center" rowspan="2">Kas</th>
          <th class="text-center vertical-center" rowspan="2">Pot. Penjualan</th>
          <th class="text-center vertical-center" rowspan="2">Penjualan</th>
          <th class="text-center vertical-center" rowspan="2">Piutang Dagang</th>
          <th class="text-center vertical-center" colspan="2">Lain-lain</th>
          
      </tr>
      <tr >
          <th class="text-center vertical-center" >Nama Akun</th>
          <th class="text-center vertical-center" >Nominal</th>
      </tr>      
    </thead>
    <tbody>
      @php
        $i=1;
      @endphp
      @foreach ($kases as $kas)
      <tr>
        <td style="width: 3px; text-align: center;">{{$i++}}</td>
        <td>{{date("d F Y",strtotime($kas->tanggal))}}</td>
        <td>{{$kas->keterangan}}</td>
        <td>{{$kas->Ref}}</td>
        <td>Rp. {{$kas->debit}}</td>
        <td>Rp. {{$kas->kredit}}</td>
        <td>Rp. {{$kas->saldo}}</td>            
      </tr>
      @endforeach
      </tbody>
  </table>
  <table class="table table-bordered text-uppercase">
    <td>Total</td>
    <td width="20%">Rp. {{$total}}</td>
  </table>
@endsection
