@extends('vendor.cetak')

@section('judul')
    Transaksi Pembelian
<div class="row">
    <div class="col-md-8">
        &nbsp;
    </div>
    <div class="col-md-2">
        <button type="button" onclick="printInvoice()" class="btn btn-fill btn-info pull-right hidden-print">Cetak</button> 
    </div>
    <div class="col-md-2">
        <a href="{{ url('penjaga/pembelian/tambah') }}" type="button" class="btn btn-fill btn-info pull-right hidden-print">Pembelian Baru</a>
    </div>
</div>    
@endsection


@section('print')
  <table>
    <tr>
      <td><h3>Nama Penjaga</h3></td>
      <td><h3>&nbsp;: {{Auth::user()->name}}</h3></td>
    </tr>
    <tr>
      <td><h3>No.Pembelian</h3></td>
      <td><h3>&nbsp;: {{$pembelians->kode_pembelian}}</h3></td>
    </tr>
    <tr>
      <td><h3>Supplier</h3></td>
      <td><h3>&nbsp;: {{$nama_supplier}}</h3></td>
    </tr>
    <tr>
      <td><h3>Tanggal</h3></td>
      <td><h3 id="tanggal">&nbsp;: {{$pembelians->tanggal}}</h3></td>
    </tr>
  </table>
  @php
    $i=1;
  @endphp
  <table class="table table-bordered " width="100%">
    <thead>
      <td style="width: 5%; text-align: center;">Nomor</td>
      <td style="text-align: center;">Nama Barang</td>
      <td style="text-align: center;">Harga Beli</td>
      <td style="text-align: center;">Jumlah</td>
      <td style="text-align: center;">Sub Total</td>      
    </thead>
    <tbody>
      @foreach ($detailPembelian as $value)
      <tr>
        <td style="text-align: center;">{{$i++}}</td>        
        <td>{{$value->nama_barang}}</td>
        <td style="text-align: center;">Rp. {{$value->harga_beli}}</td>
        <td style="text-align: center;">{{$value->jumlah_beli}}</td>
        <td style="text-align: center;">Rp. {{$value->sub_total_harga}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  <table class="table table-bordered ">    
    <td width="33%">Total Harga : Rp. {{$pembelians->total_harga_beli}}</td>
    <td width="33%">Jumlah bayar : Rp. {{$pembelians->total_bayar}}</td>
    <td width="33%">Kembalian : Rp. {{$pembelians->total_kembalian}}</td>    
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