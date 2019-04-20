@extends('layouts.app') @section('content-title', 'Laporan Kas') @section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item active">Laporan Kas</li>
</ol>
@endsection @section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="header"> 
        <h4 class="title">Laporan Kas<span class="pull-right"><a target="_blank" href={{Auth::user()->hasRole('penjaga') ? route('cetaktlaporankas',['awal'=>$awal,'akhir'=>$akhir]) : route('cetaktlaporankaspm',['awal'=>$awal,'akhir'=>$akhir])}} class="btn btn-xs btn-fill btn-success"><i class="fa fa-print"></i>Cetak</a></span></h4>
      </div>
      <div class="content table-responsive table-full-width">
        <div class="col-md-12">
          <form class="form-inline" action={{Auth::user()->hasRole('penjaga')?route('lihat_tanggalkas'):route('lihat_tanggalkaspm')}}>
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

        <table class="table table-striped table-hover">
          <thead>
          <th>Nomor</th> 
          <th>No. Transaksi</th> 
          <th>Tanggal</th>
          <th>Keterangan</th>
          <th>Debit (Rp)</th>          
          <th>Kredit (Rp)</th>
          <th>Saldo (Rp)</th>
        </thead>
        <tbody>
          @php
            $i=1;            
          @endphp
          @foreach ($kases as $kas)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$kas->ref}}</td>
            <td>{{date("d F Y",strtotime($kas->tanggal))}}</td>
            <td>{{$kas->keterangan}}</td>
            <td>Rp. {{number_format($kas->debit,0,',','.')}}</td>
            <td>Rp. {{number_format($kas->kredit,0,',','.')}}</td>
            <td>Rp. {{number_format($kas->saldo,0,',','.')}}</td>                                       
          </tr>                    
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="header">
        <h4 class="title">Total Debit</h4> 
        <p class="category">Jumlah keseluruhan dari transaksi penjualan diatas</p>
      </div>
      <div class="content">
        <table>
          <tr>
            <td>Total Debit :&nbsp;</td>
            <td>Rp. <b>{{number_format($total_debit,0,',','.')}}</b></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="header">
        <h4 class="title">Total Kredit</h4> 
        <p class="category">Jumlah keseluruhan dari transaksi pembelian diatas</p>
      </div>
      <div class="content">
        <table>
          <tr>
            <td>Total Kredit :&nbsp;</td>
            <td>Rp. <b>{{number_format($total_kredit,0,',','.')}}</b></td>
          </tr>
        </table>
      </div>      
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="header">
        <h4 class="title">Saldo Terakhir</h4> 
        <p class="category">Saldo terakhir dari transaksi diatas</p>
      </div>      
      <div class="content">
        <table>
          <tr>
            <td>Saldo terakhir :&nbsp;</td>
            <td>Rp. <b>{{number_format($kas_total,0,',','.')}}</b></td>
          </tr>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection


@section('script')
<script type="text/javascript">
var today = new Date();
document.getElementById('tanggal').value =  today.toISOString().substr(0, 10);
</script>
@endsection
