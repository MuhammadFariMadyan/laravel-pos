@extends('layouts.app') @section('content-title', 'Laporan Kas') @section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item active">Laporan Kas</li>
</ol>
@endsection @section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
        <h4 class="title">Laporan Kas<span><span class="pull-right"></span></h4>
      </div>
      <div class="content table-responsive table-full-width">
        <div class="col-md-12">
          <form class="form-inline" action={{Auth::user()->hasRole('penjaga')?route('lihat_tanggalkas'):route('lihat_tanggalkaspm')}}>
            <div class="form-group">
              <label for="">Tanggal&nbsp;:&nbsp;</label>
              <input type="date" class="form-control input-sm" id="tanggalawal" name="tanggalawal" placeholder="Contoh: 20/01/2017">
            </div>
            <i class="fa fa-arrows-h fa-lg"></i>
            <div class="form-group">
              <input type="date" class="form-control input-sm" id="tanggalakhir" name="tanggalakhir" placeholder="Contoh: 20/01/2017">
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
        <!-- <tbody>
          @php
            $i=1;
          @endphp
          @foreach ($kases as $kas)
          <tr>
            <td>{{$i++}}</td>
            <td>{{date("d F Y",strtotime($kas->tanggal))}}</td>
            <td>{{$kas->keterangan}}</td>
            <td>{{$kas->Ref}}</td>
            <td>Rp. {{$kas->debit}}</td>
            <td>Rp. {{$kas->kredit}}</td>
            <td>Rp. {{$kas->saldo}}</td>            
          </tr>
          @endforeach
          </tbody> -->
        </table>
        <center>{{ $kases->links() }}</center>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
var today = new Date();
document.getElementById('tanggalawal').value =  today.toISOString().substr(0, 10);
document.getElementById('tanggalakhir').value =  today.toISOString().substr(0, 10);
</script>
@endsection
