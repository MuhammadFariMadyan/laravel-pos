@extends('layouts.app') @section('content-title', 'Data Penjaga') @section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item active"><a href="{{route('datapenjaga')}}">Data Penjaga</a></li>
  <li class="breadcrumb-item active">Tambah Data Penjaga</li>
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
        <form action="{{route('simpanpenjaga')}}" method="post">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Max 12 Character" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="@gmail.com">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="ket">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
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
