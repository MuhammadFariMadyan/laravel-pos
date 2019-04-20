@extends('layouts.app')

@section('content-title', 'Data Transaksi Pembelian')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">Data Transaksi Pembelian</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
                          <div class="card">
                              <div class="header">
                                  <h4 class="title">Pembelian<span class="pull-right">&nbsp;<a href="{{ URL::previous() }}" class="btn btn-xs btn-fill btn-info">Kembali</a></span><span class="pull-right">                                    
                                  </span></h4>
                              </div>
                              <div class="content table-responsive table-full-width">
                                <div class="col-md-12">                                                                   
                                  
                                  <form class="form-inline" action="{{route('lihat_tanggalpembelian')}}">
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
                                  {{-- {!! $html->table(['class'=>'table table-striped table-hover'])!!} --}}
                                  <table class="table table-striped table-hover">
                                    <thead>
                                      <th>Nomor</th>
                                      <th>Kode Pembelian</th>
                                      <th>Tanggal</th>
                                      <th>Nama Supplier</th>                                      
                                      <th>Total Harga (Rp)</th>                                      
                                      <th>Tools</th>
                                    </thead>
                                    <tbody>                                      
                                    </tbody>
                                  </table>
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
