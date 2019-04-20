@extends('layouts.app') @section('content-title', 'Data Penjaga') @section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('datapenjaga')}}">Data Penjaga</a></li>
  <li class="breadcrumb-item active">Ubah Data Penjaga</li>
</ol>
@endsection @section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
        <h4 class="title">Data Penjaga</h4>
        <p class="category">Silahkan masukkan data penjaga dengan benar..</p>
      </div>
      <div class="content">
        <form action="{{route('ubahpenjaga',$penjaga->id)}}" method="post">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{$penjaga->name}}" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Tidak boleh sama.." value="{{$penjaga->username}}" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{$penjaga->email}} "class="form-control" readonly placeholder="@gmail.com">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-info btn-fill pull-right">Ubah Penjaga</button>

          <div class="clearfix"></div>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
