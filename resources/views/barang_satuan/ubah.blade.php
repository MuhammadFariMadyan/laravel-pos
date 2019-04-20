@extends('layouts.app') @section('content-title', 'Edit Satuan Barang') @section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('databarang_satuan')}}">Data Satuan Barang</a></li>
  <li class="breadcrumb-item active">Edit Satuan Barang</li>
</ol>
@endsection @section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
        <h4 class="title">Edit Satuan Barang<span class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-xs btn-fill btn-info">Kembali</a></span></h4>
        <p class="category">Silahkan masukkan data satuan barang dengan benar..</p>
      </div>
      <div class="content">
        <form class="form-horizontal" action="{{route('ubahbarang_satuan',$barang_satuan->idbarang_unit)}}" method="post">

          <div class="row">
            <div class="col-md-12" style="margin-left:25%;">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Satuan Barang</label>
                  <input type="text" name="unit" class="form-control" placeholder="Satuan Barang.." required value="{{$barang_satuan->unit}}">
                </div>
              </div>            
            </div>
          </div>

          <button type="submit" class="btn btn-info btn-fill pull-right">Update Barang</button>
          <div class="clearfix"></div>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
