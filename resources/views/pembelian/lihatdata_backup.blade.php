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
                <h4 class="title">Pembelian<span class="pull-right">&nbsp;<a href="{{route('tambahpembelian')}}" class="btn btn-xs btn-fill btn-info">Tambah Transaksi Pembelian</a></span><span class="pull-right"><a href="{{route('cetakpembelian',$tanggal)}}" target="_blank" class="btn btn-xs btn-fill btn-success"><i class="fa fa-print"></i>Cetak</a></span></h4>
            </div>
            <div class="content table-responsive table-full-width">
              <div class="col-md-12">
                <form class="form-inline" action="{{route('lihat_tanggalpembelian')}}">
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
                    <th>Kode Pembelian</th>
                    <th>Tanggal</th>
                    <th>Nama Supplier</th>                                      
                    <th>Total Harga</th>
                    <th>Jumlah Bayar</th>
                    <th>Kembalian</th>
                    <th>Tools</th>
                  </thead>
                  <tbody>
                    @php
                      $i=1;
                    @endphp
                    @foreach ($pembelians as $pembelian)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$pembelian->kode_pembelian}}</td>
                      <td>{{$pembelian->tanggal}}</td>
                      <td>{{$pembelian->nama_supplier}}</td>
                      <td>{{$pembelian->total_harga_beli}}</td>
                      <td>{{$pembelian->total_bayar}}</td>
                      <td>{{$pembelian->total_kembalian}}</td>
                      <td class="text-center"><a target="_blank" href="{{route('nota_pembelian',$pembelian->id)}}" class="btn btn-xs btn-info btn-fill"><i class="fa fa-print"></i></a>
                        {{ Form::open(['url' => route('hapuspembelian', $pembelian->id), 'method' => 'delete', 'class' => 'form-inline']) }}
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
