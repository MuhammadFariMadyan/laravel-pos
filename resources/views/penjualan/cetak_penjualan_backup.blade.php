@extends('vendor.cetak')

@section('judul')
    Transaksi Penjualan
<div class="row">
    <div class="col-md-8">
        &nbsp;
    </div>
    <div class="col-md-2">
        <button type="button" onclick="printInvoice()" class="btn btn-fill btn-info pull-right hidden-print">Cetak</button> 
    </div>
    <div class="col-md-2">
        <a href="{{ url('penjaga/penjualan/tambah') }}" type="button" class="btn btn-fill btn-info pull-right hidden-print">Penjualan Baru</a>
    </div>
</div>    
@endsection

@section('print')
  <table>
    <tr>
      <td style="height: 40px;">Nama Penjaga : {{Auth::user()->name}}</td>
    </tr>
    <br>
    <tr>
      <td style="height: 40px;">No.Penjualan : {{$penjualans->kode_penjualan}}</td>
    </tr>
    <br>
    <tr>
      <td style="height: 40px;">Pelanggan : {{$penjualans->pelanggan}}</td>
    </tr>
    <br>
    <tr>
      <td style="height: 40px;">Tanggal : {{date("d F Y",strtotime($penjualans->tanggal))}}</td>
    </tr>    
  </table>
  <br>
  @php
    $i=1;
  @endphp
  <table class="table table-bordered " width="100%">
    <thead>
      <td style="width: 5%; text-align: center;">Nomor</td>
      <td style="text-align: center;">Nama Barang</td>
      <td style="text-align: center;">Harga jual</td>
      <td style="text-align: center;">Diskon</td>
      <td style="text-align: center;">Harga jual Akhir</td>
      <td style="text-align: center;">Jumlah</td>
      <td style="text-align: center;">Sub Total</td>      
    </thead>
    <tbody>
      @foreach ($detailPenjualan as $value)
      <tr>
        <td>{{$i++}}</td>        
        <td>{{$value->nama_barang}}</td>
        <td>Rp. {{$value->harga_jual}}</td>
        <td>{{$value->diskon}} %</td>
        <td>Rp. {{$value->harga_jual_akhir}}</td>
        <td>{{$value->jumlah_jual}}</td>
        <td>Rp. {{$value->sub_total_harga}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  <table class="table table-bordered ">    
    <td width="33%">Total Harga : Rp. {{$penjualans->total_harga_jual}}</td>    
    <td width="33%">Jumlah bayar : Rp. {{$penjualans->total_bayar}}</td>    
    <td width="33%">Kembalian : Rp. {{$penjualans->total_kembalian}}</td>    
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
<!-- <hr class="hidden-print"/> -->
@endsection

<script>
function printInvoice() {
    window.print();
}
</script>