@extends('layouts.app') @section('content-title', 'Tambah Retur Pembelian') @section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('datareturpenjualan')}}">Data Retur Pembelian</a></li>
  <li class="breadcrumb-item active">Tambah Retur Pembelian</li>
</ol>
@endsection @section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
        <h4 class="title">Tambah Retur Pembelian<span class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-xs btn-fill btn-info"><i class="fa fa-arrow-circle-left"></i>&nbsp;Kembali</a></span></h4>
        <p class="category">Silahkan masukkan data retur pembelian dengan benar..</p>
      </div>
      <div class="content">
        <form action="{{route('simpanreturpembelian')}}" method="post">

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>No Retur</label>
                <input type="text" name="no_retur" value="{{$kodePenjualan}}" readonly class="form-control" placeholder="" required>
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
                <label>Nama Supplier</label>
                <select class="form-control" id="nama_supplier" name="nama_supplier" style="width: 100%" required></select>
              </div>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Barcode/PLU</label>
                <select class="form-control" id="plu" name="plu" style="width: 100%" required></select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="ket">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="" readonly required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="ket">Jumlah</label>
                <input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="" required>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3"></textarea>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>

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
    $('#plu').select2({
      placeholder: 'Cari Barang..',
      minimumInputLength: 3,
      ajax: {
        url: '{{route('searchidbarang')}}',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
                  return {
                      text: item.kode_barang,
                      id:item.kode_barang+','+item.nama_barang
                  }
              })
          };
        },
        cache: true
      }
    });
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

    $('#plu').change(function() {
      var nama_barang = this.value.split(",").pop();
      $('#nama_barang').val(nama_barang);
    });

    var today = new Date();
    document.getElementById('tanggal').value =  today.toISOString().substr(0, 10);
    //
    // $(document).ready(function(){
    //     $("#jumlah").keyup(function(){
    //         var jumlah_barang = document.getElementById('jumlah').value;
    //         var harga_beli = document.getElementById('harga_beli').value;
    //         var subtotal = jumlah_barang * harga_beli;
    //         document.getElementById('total').value = subtotal;
    //     });
    // });


    </script>
@endsection
