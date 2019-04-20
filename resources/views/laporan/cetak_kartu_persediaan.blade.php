@extends('vendor.cetak')

@section('judul')
Kartu Persediaan barang Per barang
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
    <tr>
      <td><h3>Kode Barang</h3></td>
      <td><h3>&nbsp;: {{$kartu_persediaan_keterangan->kode_barang}} </h3></td>
    </tr>
    <tr>
      <td><h3>Nama Barang</h3></td>
      <td><h3>&nbsp;: {{$kartu_persediaan_keterangan->nama_barang}} </h3></td>
    </tr>
  </table>
  @php
    $i=1;
  @endphp
  <table class="table table-bordered">
      <thead>
        <th style="text-align: center;">Nomor</th>                                    
        <th style="text-align: center;">Tanggal</th>
        <th style="text-align: center;">Keterangan</th>
        <th style="text-align: center;">Stok Awal / In</th>
        <th style="text-align: center;">Stok Jual / Out</th>
        <th style="text-align: center;">Saldo Stok</th>
      </thead>
      @php
        $i=1;
      @endphp
      @foreach ($kartu_persediaan as $kartu_persediaans)
      <tr>
        <td style="text-align: center;">{{$i++}}</td>                  
        <td style="text-align: center;">{{$kartu_persediaans->tanggal}}</td>
        <td style="text-align: center;">{{$kartu_persediaans->keterangan}}</td>
        <td style="text-align: center;" width="15%">
            <?php if ($kartu_persediaans->masuk > 0): ?>
              {{$kartu_persediaans->masuk}}
              <?php else: ?>
                -
            <?php endif ?>
        </td>
        <td style="text-align: center;" width="15%">
            <?php if ($kartu_persediaans->keluar > 0): ?>
              {{$kartu_persediaans->keluar}}
              <?php else: ?>
                -
            <?php endif ?>
        </td>                  
        <td style="text-align: center;" width="15%">
            <?php if ($kartu_persediaans->sisa > 0): ?>
              {{$kartu_persediaans->sisa}}
              <?php else: ?>
                -
            <?php endif ?>
        </td>
      </tr>
    @endforeach
    </table>
  <table class="table table-bordered">
    <td width="55%"><b>Total In</b></td>    
    <td width="15%" style="text-align: center;"><b>{{$total_in}}</b></td>
    <td></td>    
  </table>
  <table class="table table-bordered">
    <td width="70%"><b>Total Out</b></td>
    <td width="15%" style="text-align: center;"><b>{{$total_out}}</b></td>
    <td></td>
  </table>
  <br>
  <h3><span class="pull-right">Diperiksa Oleh</span></h3>
  <h3><span class="pull-left">Dibuat Oleh</span></h3>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <h3><span class="pull-right">TTD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></h3>
  <h3><span class="pull-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TTD</span></h3>
  <br>
  <h3><span class="pull-right">Pemilik Toko</span></h3>
  <h3><span class="pull-left">Penjaga Toko</span></h3>
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
