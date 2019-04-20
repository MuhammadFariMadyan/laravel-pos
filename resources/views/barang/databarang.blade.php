<?php 
  function toRupiah($angka){
    $uangRupiah = "Rp " . number_format($angka,0,',','.');
    return $uangRupiah;
  }
 ?>
@extends('layouts.app')

@section('content-title', 'Data Barang')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">Data Barang</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Data Barang<span class="pull-right"><a href="{{route('tambahbarang')}}" class="btn btn-xs btn-fill btn-info">Tambah Barang</a></span></h4>
            </div>
            <div class="content table-responsive table-full-width">                                                
              <table  class="table table-striped table-hover" id="dataTabelDataBarang">
                <thead>
                  <th class="text-center">Nomor</th>                  
                  <th class="text-center">Kode Barang</th>
                  <th class="text-center">Nama Barang</th>
                  <th class="text-center">Satuan</th>
                  <th class="text-center">Kategori</th>
                  <th class="text-center">Stok</th>                  
                  <th class="text-center">Harga Beli</th>
                  <th class="text-center">Harga Jual</th>                  
                  <th class="text-center">Diskon</th>
                  <th class="text-center">Harga</th>
                  <th class="text-center">Action</th>                         
                </thead>
                <tbody>
                  @php
                    $i=1;
                  @endphp
                  @foreach ($barang as $barangs)
                  <tr>
                    <td class="text-center">{{$i++}}</td>
                    <td class="text-center">{{$barangs->kode_barang}}</td>                    
                    <td>{{$barangs->nama_barang}}</td>
                    <td class="text-center">{{$barangs->unit}}</td>
                    <td class="text-center">{{$barangs->kategori}}</td>
                    <td class="text-center">{{$barangs->stok}}</td>
                    <td class="text-center">{{toRupiah($barangs->harga_beli)}}</td>
                    <td class="text-center">{{toRupiah($barangs->harga_jual)}}</td>
                    <td class="text-center">{{$barangs->diskon}}%</td>
                    <td class="text-center">{{toRupiah($barangs->harga_jual_akhir)}}</td>
                    <td class="text-center"><a href="{{route('ngubahbarang', $barangs->id)}}" class="btn btn-xs btn-success btn-fill"><i class="fa fa-edit"></i></a>
                      {{ Form::open(['url' => route('hapusbarang', $barangs->id), 'method' => 'delete', 'class' => 'form-inline']) }}
                        {!! Form::button('<i class="fa fa-trash"id="btnPopover1" title="Tekan tombol ini jika anda mau menghapus data" data-toggle="tooltip"></i>', ['type'=>'submit','class'=>'btn btn-xs btn-fill btn-danger']) !!}
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
  $(document).ready(function() {
    $('#btnPopover1').tooltip();  
  });
  </script>

<script>
      $(function () {

        $('#dataTabelDataBarang').DataTable({"pageLength": 5, "scrollX": true});

      });

    </script>
@endsection
