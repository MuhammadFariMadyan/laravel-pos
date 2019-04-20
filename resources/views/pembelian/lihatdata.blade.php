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
                <h4 class="title">Pembelian<span class="pull-right">&nbsp;<a href="{{route('tambahpembelian')}}" class="btn btn-xs btn-fill btn-info">Tambah Transaksi Pembelian</a></span><span class="pull-right">
                  <a href="{{route('cetakpembelian',['awal'=>$awal,'akhir'=>$akhir])}}" target="_blank" class="btn btn-xs btn-fill btn-success"><i class="fa fa-print"></i>Cetak</a>
                </span></h4>                
            </div>
            <div class="content table-responsive table-full-width">
              <div class="col-md-12">
                <form class="form-inline" action="{{route('lihat_tanggalpembelian')}}">
                  <div class="form-group">
                    <label for="">Tanggal&nbsp;:&nbsp;</label>
                    <input type="date" class="form-control input-sm" id="tanggalawal" name="tanggalawal" value="{{$awal}}">
                  </div>
                  <i class="fa fa-arrows-h fa-lg"></i>
                  <div class="form-group">
                    <input type="date" class="form-control input-sm" id="tanggalakhir" name="tanggalakhir" value="{{$akhir}}">
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
                    <th>Total Harga (Rp)</th>                    
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
                      <td>{{date("d F Y",strtotime($pembelian->tanggal))}}</td>
                      <td>{{$pembelian->nama_supplier}}</td>
                      <td>Rp. {{$pembelian->total_harga_beli}}</td>                      
                      <td class="text-center"><a target="_blank" href="{{route('nota_pembelian',$pembelian->id)}}" class="btn btn-xs btn-info btn-fill"><i class="fa fa-print"></i></a>                        
                        </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="header">
          <h4 class="title">Total Harga</h4>
          <p class="category">Jumlah keseluruhan dari data diatas:</p>
        </div>
        <div class="content">
          <table>
            <tr>
              <td>Total Keseluruhan :&nbsp;</td>
              <td>Rp. <b>{{number_format($harga_total,0,',','.')}}</b></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
