@extends('layouts.app') @section('content-title', 'Data Transaksi Penjualan') @section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item active">Data Transaksi Penjualan</li>
</ol>
@endsection @section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
        <h4 class="title">Penjualan<span class="pull-right">&nbsp;<a href="{{route('tambahpenjualan')}}" class="btn btn-xs btn-fill btn-info">Tambah Transaksi Penjualan</a></span><span class="pull-right"><a href="{{route('cetakpenjualan',$tanggal)}}" target="_blank" class="btn btn-xs btn-fill btn-success"><i class="fa fa-print"></i>Cetak</a></span></h4>
      </div>
      <div class="content table-responsive table-full-width">
        <div class="col-md-12">
          <form class="form-inline" action="{{route('lihat_tanggalpenjualan')}}">
            <div class="form-group">
              <label for="">Tanggal&nbsp;:&nbsp;</label>
              <input type="date" name="tanggal" class="form-control input-sm" id="tanggal" placeholder="Contoh: 20/01/2017">
            </div>&nbsp;
            <button type="submit" class="btn btn-warning btn-fill btn-sm">Tampilkan</button>
          </form>
        </div>
        {{-- {!! $html->table(['class'=>'table table-striped table-hover'])!!} --}}
        <table  class="table table-striped table-hover">
          <thead>
            <th class="text-center">Nomor</th>
            <th class="text-center">No. Penjualan</th>
            <th class="text-center">Nama Penjaga</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Pelanggan</th>
            <th class="text-center">Total Harga Jual</th>
            <th class="text-center">Jumlah bayar</th>
            <th class="text-center">Kembalian</th>
            <th class="text-center">Tools</th>
          </thead>
          <tbody>
            @php
              $i=1;
            @endphp
            @foreach ($penjualans as $penjualan)
            <tr>
              <td class="text-center">{{$i++}}</td>
              <td class="text-center">{{$penjualan->kode_penjualan}}</td>
              <td class="text-center">{{$penjualan->createdby}}</td>
              <td class="text-center">{{$penjualan->tanggal}}</td>
              <td class="text-center">{{$penjualan->pelanggan}}</td>
              <td class="text-center">Rp. {{$penjualan->total_harga_jual}}</td>
              <td class="text-center">Rp. {{$penjualan->total_bayar}}</td>
              <td class="text-center">Rp. {{$penjualan->total_kembalian}}</td>
              <td class="text-center"><a target="_blank" href="{{route('nota_penjualan',$penjualan->id)}}" class="btn btn-xs btn-info btn-fill"><i class="fa fa-print"></i></a>
                {{ Form::open(['url' => route('hapuspenjualan', $penjualan->id), 'method' => 'delete', 'class' => 'form-inline']) }}
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
@endsection
