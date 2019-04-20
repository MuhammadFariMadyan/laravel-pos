@extends('layouts.app')

@section('content-title', 'Data Retur Penjualan')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">Data Retur Penjualan</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
                          <div class="card">
                              <div class="header">
                                  <h4 class="title">Retur Penjualan<span class="pull-right">&nbsp;<a href="{{route('tambahreturpenjualan')}}" class="btn btn-xs btn-fill btn-info">Tambah Retur Penjualan</a></span><span class="pull-right"><a targe="_blank" href="{{route('cetakreturpenjualan',$tanggal)}}" class="btn btn-xs btn-fill btn-success"><i class="fa fa-print"></i>Cetak</a></span></h4>
                              </div>
                              <div class="content table-responsive table-full-width">
                                <div class="col-md-12">
                                  <form class="form-inline" action="{{route('lihat_tanggalreturpenjualan')}}">
                                    <div class="form-group">
                                      <label for="">Tanggal&nbsp;:&nbsp;</label>
                                      <input type="date" class="form-control input-sm" id="tanggal" name="tanggal" placeholder="Contoh: 20/01/2017">
                                    </div>&nbsp;
                                    <button type="submit" class="btn btn-success btn-fill btn-sm">Tampilkan</button>
                                  </form>
                                </div>
                                  {{-- {!! $html->table(['class'=>'table table-striped table-hover'])!!} --}}
                                  <table class="table table-striped table-hover">
                                    <thead>
                                      <th>Nomor</th>
                                      <th>No Retur</th>
                                      <th>Tanggal</th>
                                      <th>Nama Penjaga</th>
                                      <th>Kode Barang</th>
                                      <th>Nama Barang</th>
                                      <th>Jumlah</th>
                                      <th>Keterangan</th>
                                      <th>Tools</th>
                                    </thead>
                                    <tbody>
                                      @php
                                        $i=1;
                                      @endphp
                                      @foreach ($returs as $retur)
                                      <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$retur->no_retur}}</td>
                                        <td>{{$retur->tanggal}}</td>
                                        <td>{{$retur->nama_penjaga}}</td>
                                        <td>{{$retur->kode_barang}}</td>
                                        <td>{{$retur->nama_barang}}</td>
                                        <td>{{$retur->jumlah}}</td>
                                        <td>{{$retur->keterangan}}</td>
                                        <td class="text-center">
                                          {{-- <a href="" class="btn btn-xs btn-info btn-fill"><i class="fa fa-print"></i></a> --}}
                                          {{ Form::open(['url' =>route('hapusreturpenjualan',$retur->id), 'method' => 'delete', 'class' => 'form-inline']) }}
                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type'=>'submit','class'=>'btn btn-xs btn-fill btn-danger']) !!}
                                          {{ Form::close() }}
                                          </td>
                                      </tr>
                                    @endforeach
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
  document.getElementById('tanggal').value =  today.toISOString().substr(0, 10);
</script>
@endsection
