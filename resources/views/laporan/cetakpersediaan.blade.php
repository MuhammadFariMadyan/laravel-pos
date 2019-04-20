@extends('vendor.cetak')

@section('judul')
Laporan Persediaan
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
  <table class="table table-bordered">
      <thead>
        <th style="text-align: center;">No.</th>                  
        <th style="text-align: left;">Nama Barang</th>                                
        <th style="text-align: center;">Stok Awal / In</th>
        <th style="text-align: center;">Stok Jual / Out</th>
        <th style="text-align: center;">Saldo Stok</th>
        <th style="text-align: center;">Harga Jual (Rp)</th>
        <th style="text-align: center;">Harga Beli (Rp)</th>
      </thead>
      @php
        $i=1;
      @endphp
      @foreach ($persediaans as $persediaan)
      <tr>
        <td style="text-align: center;">{{$i++}}</td>                  
        <td>{{$persediaan->nama_barang}}</td>                                                      
        <td style="text-align: center;">
            <?php if (!is_null($persediaan->stok_beli)): ?>
              {{$persediaan->stok_beli}}
              <?php else: ?>
                0
            <?php endif ?>
        </td>
        <td style="text-align: center;">
            <?php if (!is_null($persediaan->stok_jual)): ?>
              {{$persediaan->stok_jual}}
              <?php else: ?>
                0
            <?php endif ?>
        </td>
        <td style="text-align: center;">
            <?php if (!is_null($persediaan->stok)): ?>
              {{$persediaan->stok}}
              <?php else: ?>
                0
            <?php endif ?>
        </td>
        <td style="text-align: center;">
            <?php if (!is_null($persediaan->harga_jual)): ?>              
              Rp. {{number_format($persediaan->harga_jual,0,',','.')}}
              <?php else: ?>
                Rp. 0
            <?php endif ?>           
        </td>
        <td style="text-align: center;">
            <?php if (!is_null($persediaan->harga_jual)): ?>              
              Rp. {{number_format($persediaan->harga_beli,0,',','.')}}
              <?php else: ?>
                Rp. 0
            <?php endif ?>           
        </td>
      </tr>
    @endforeach
    </table>
  <table class="table table-bordered text-uppercase">
    <td>Total</td>
    <td width="91%" align="right">{{$total}} Barang</td>
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
