@extends('layouts.app') @section('content-title', 'Tambah Laporan Kas') @section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('datapembelian')}}">Laporan Kas</a></li>
  <li class="breadcrumb-item active">Tambah Laporan Kas</li>
</ol>
@endsection @section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
        <h4 class="title">Tambah Laporan Kas<span class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-xs btn-fill btn-info"><i class="fa fa-arrow-circle-left"></i>&nbsp;Kembali</a></span></h4>
        <p class="category">Silahkan masukkan laporan kas dengan benar..</p>
      </div>
      <div class="content">
        <form action="{{route('simpankas')}}" method="post">

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Kode persediaan</label>
                <input type="text" name="kode_struk" value="" readonly class="form-control" placeholder="" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="tgl">Nama Penaga</label>
                <select class="form-control" id="nama_penjaga" name="nama_penjaga" style="width: 100%"></select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="keterangan" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="ket">Jumlah</label>
                <input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="ket">Tanggal Penjualan</label>
                <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" class="form-control" placeholder="" required>
              </div>
            </div>
          <button type="submit" class="btn btn-info btn-fill pull-right">Tambah Transaksi Pembelian</button>

          <div class="clearfix"></div>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
    $('#nama_supplier').select2({
      placeholder: 'Pilih Supplier..',
      minimumInputLength: 3,
      ajax: {
        url: '{{route('searchsupplier')}}',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
                  return {
                      text: item.nama_supplier,
                      id:item.nama_supplier
                  }
              })
          };
        },
        cache: true
      }
    });


    var today = new Date();
    document.getElementById('tanggal').value =  today.toISOString().substr(0, 10);
    </script>
@endsection
