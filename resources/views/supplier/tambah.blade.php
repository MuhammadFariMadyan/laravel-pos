@extends('layouts.app') @section('content-title', 'Tambah Supplier') @section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href={{Auth::user()->hasRole('penjaga') ? route('datasupplier') : route('datasupplierpm')}}>Data Supplier</a></li>
  <li class="breadcrumb-item active">Tambah Supplier</li>
</ol>
@endsection @section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
        <h4 class="title">Tambah Supplier<span class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-xs btn-fill btn-info"><i class="fa fa-arrow-circle-left"></i>&nbsp;Kembali</a></span></h4>
        <p class="category">Silahkan masukkan data supplier dengan benar..</p>
      </div>
      <div class="content">
        <form class="" action={{Auth::user()->hasRole('penjaga') ? route('ketambahsupplier') : route('ketambahsupplierpm')}} method="post">

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Kode Supplier</label>
                <input type="text" name="kode_supplier" class="form-control" value="{{$kode_supplier}}" readonly>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Nama Supplier</label>
                <input type="text" class="form-control" name="nama_supplier" placeholder="Nama Supplier" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tgl">Alamat Supplier</label>
                <input type="text" name="alamat_supplier" id="tgl" class="form-control" placeholder="Isi alamat lengkap anda.." required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Nomor Handphone</label>
                <input type="number" name="no_hp" class="form-control" placeholder="+628xx" required>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="ket">Keterangan</label>
                <textarea class="form-control" name="keterangan" id="ket" rows="2" required></textarea>
              </div>
              <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
            </div>
          </div>


          <div class="clearfix"></div>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
