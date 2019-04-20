@extends('layouts.app') @section('content-title', 'Tambah Penjualan') @section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('datapenjualan')}}">Data Transaksi Penjualan</a></li>
  <li class="breadcrumb-item active">Tambah Transaksi Penjualan</li>
</ol>
@endsection @section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
        <h4 class="title">Tambah Transaksi Penjualan<span class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-xs btn-fill btn-info"><i class="fa fa-arrow-circle-left"></i>&nbsp;Kembali</a></span></h4>
        <p class="category">Silahkan masukkan data penjualan dengan benar..</p>
      </div>
      <div class="content">
        <form class="" action="{{route('simpanpenjualan')}}" method="post">

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Kode/No Penjualan</label>
                <input type="text" name="kode_penjualan" value="" readonly class="form-control" style="text-transform: uppercase" required>
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
                <label for="tgl">Barcode</label>
                <input type="text" name="" id="tgl" class="form-control" placeholder="">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama Barang</label>
                <select class="form-control" id="nama_barang" name="nama_barang" style="width: 100%" ></select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="ket">Harga Jual</label>
                <input type="text" name="harga_jual" id="harga_jual" class="form-control" readonly placeholder="" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="ket">Jumlah</label>
                <input type="text" name="jumlah" id="jumlah_barang" class="form-control" placeholder="" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="diskon">Stok</label>
                <input type="text" name="stok" id="diskon" class="form-control" placeholder="" required readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="total">Total(RP)</label>
                <input type="text" name="total" id="total" class="form-control" placeholder="" required readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="total">Nama Penjaga</label>
                <input type="text" name="nama_penjaga" class="form-control" placeholder="" value="{{Auth::user()->name}}" required readonly>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-info btn-fill btn-sm pull-right">Simpan</button>
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
        $('#nama_barang').select2({
          placeholder: 'Pilih barang..',
          minimumInputLength: 3,
          ajax: {
            url: '{{route('searchbarang')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                      return {
                          text: item.nama_barang,
                          id:item.stok+','+item.nama_barang+','+item.harga_jual
                      }
                  })
              };
            },
            cache: true
          }
        });

        $('#nama_barang').change(function() {
          var harga = this.value.split(",").pop();
          $('#harga_jual').val(harga);
          var diskon = this.value.split(",").shift();
          $('#diskon').val(diskon);
        });

      var today = new Date();
      document.getElementById('tanggal').value =  today.toISOString().substr(0, 10);

      $(document).ready(function(){
          $("#jumlah_barang").keyup(function(){
              var jumlah_barang = document.getElementById('jumlah_barang').value;
              var diskon_barang = document.getElementById('diskon').value;
              var harga_jual = document.getElementById('harga_jual').value;
              var subtotal = jumlah_barang * harga_jual;
              var diskon = (subtotal/100)*diskon_barang;
              var total = subtotal - diskon;
              document.getElementById('total').value = total;
          });
      });

  </script>
@endsection
