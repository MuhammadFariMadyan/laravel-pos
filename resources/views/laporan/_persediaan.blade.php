@extends('layouts.app')

@section('content-title', 'Laporan Persediaan')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">Laporan Persediaan</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
      <div class="card">
          <div class="header">
              <h4 class="title">Laporan Persediaan<span class="pull-right"></span></h4>
          </div>
          <div class="content table-responsive table-full-width">
            <div class="col-md-12">                                                                    

              <form class="form-inline" action="{{Auth::user()->hasRole('penjaga') ? route('lihatlaporanpersediaan') : route('lihatlaporanpersediaanpm')}}">
                <input type="hidden" id="id_barang" name="id_barang">                  

                <div class="form-group">
                  <label for="">Tanggal&nbsp;:&nbsp;</label>
                  <input type="date" class="form-control input-sm" id="tanggalawal" name="tanggalawal" placeholder="Contoh: 20/01/2017">
                </div>
                <i class="fa fa-arrows-h fa-lg"></i>
                <div class="form-group">
                  <input type="date" class="form-control input-sm" id="tanggalakhir" name="tanggalakhir" placeholder="Contoh: 20/01/2017">
                </div> &nbsp;&nbsp;                
                <button type="submit" class="btn btn-success btn-fill btn-sm">Tampilkan</button>
                
              </form>

            </div>
              {{-- {!! $html->table(['class'=>'table table-striped table-hover'])!!} --}}
              <table class="table table-striped table-hover">
                <thead>
                 <!--  <th style="text-align: center;">Nomor</th>
                  <th style="text-align: center;">Tanggal</th>                            
                  <th style="text-align: center;">Nama Supplier</th>    
                  <th style="text-align: center;">Nama Barang</th>              
                  <th style="text-align: center;">Harga Jual</th>
                  <th style="text-align: center;">Stok Beli</th>
                  <th style="text-align: center;">Stok Jual</th>
                  <th style="text-align: center;">Jumlah Stok</th> -->
                </thead>
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
