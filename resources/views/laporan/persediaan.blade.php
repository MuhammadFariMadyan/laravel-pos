@extends('layouts.app')

@section('content-title', 'Laporan Persediaan')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">Laporan Persediaan</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
      <div class="card">
          <div class="header"> 
              <h4 class="title">Laporan Persediaan<span class="pull-right"><a target="_blank" href={{Auth::user()->hasRole('penjaga') ? route('cetakpersediaan',['awal'=>$awal,'akhir'=>$akhir]) : route('cetakpersediaanpm',['awal'=>$awal,'akhir'=>$akhir])}} class="btn btn-xs btn-fill btn-success"><i class="fa fa-print"></i>Cetak</a></span></h4>
          </div>   
          <br>     
            <!-- <div class="col-md-10">                                                                     -->
              <form class="form-inline" action="{{Auth::user()->hasRole('penjaga') ? route('lihatlaporanpersediaan') : route('lihatlaporanpersediaanpm')}}" style="margin-left: 2%;">
                <input type="hidden" id="id_barang" name="id_barang">                  

                <div class="form-group">
                  <label for="">Tanggal&nbsp;:&nbsp;</label>
                  <input type="date" class="form-control input-sm" id="tanggalawal" name="tanggalawal" value="{{$awal}}"">
                </div>
                <i class="fa fa-arrows-h fa-lg"></i>
                <div class="form-group">
                  <input type="date" class="form-control input-sm" id="tanggalakhir" name="tanggalakhir" value="{{$akhir}}">
                </div> &nbsp;&nbsp;                
                <button type="submit" class="btn btn-success btn-fill btn-sm">Tampilkan</button>
                
              </form>
            <!-- </div> -->
            <hr>
              <div class="content table-responsive table-full-width">                  
              <table  class="table table-striped table-hover" id="dataTabelDataPersediaan">
                <thead>
                  <th style="text-align: center;">No.</th>                  
                  <th style="text-align: left;">Nama Barang</th>                                
                  <th style="text-align: center;">Stok Awal / In</th>
                  <th style="text-align: center;">Stok Jual / Out</th>
                  <th style="text-align: center;">Saldo Stok</th>
                  <th style="text-align: center;">Harga Jual (Rp)</th>
                  <th style="text-align: center;">Harga Beli (Rp)</th>
                  <th style="text-align: center;">Action</th>
                </thead>
                @php
                  $i=1;
                @endphp
                @foreach ($persediaans as $persediaan)
                <tr>
                  <td style="text-align: center;">{{$i++}}</td>                  
                  <td>{{$persediaan->nama_barang}}</td>                                                      
                  <td style="text-align: center;">
                      <?php if (!is_null($persediaan->stok_beli)): ?>
                        {{$persediaan->stok_beli}}
                        <?php else: ?>
                          0
                      <?php endif ?>
                  </td>
                  <td style="text-align: center;">
                      <?php if (!is_null($persediaan->stok_jual)): ?>
                        {{$persediaan->stok_jual}}
                        <?php else: ?>
                          0
                      <?php endif ?>
                  </td>
                  <td style="text-align: center;">
                      <?php if (!is_null($persediaan->stok)): ?>
                        {{$persediaan->stok}}
                        <?php else: ?>
                          0
                      <?php endif ?>
                  </td>
                  <td style="text-align: center;">
                      <?php if (!is_null($persediaan->harga_jual)): ?>                        
                        Rp. {{number_format($persediaan->harga_jual,0,',','.')}}
                        <?php else: ?>
                          Rp. 0
                      <?php endif ?>           
                  </td>
                  <td style="text-align: center;">
                      <?php if (!is_null($persediaan->harga_jual)): ?>                        
                        Rp. {{number_format($persediaan->harga_beli,0,',','.')}}
                        <?php else: ?>
                          Rp. 0
                      <?php endif ?>           
                  </td>
                  <td class="text-center">
                    {{ Form::open(['url' => route('cetakkartupersediaan', ['awal'=>$awal,'akhir'=>$akhir, 'id_barang'=> $persediaan->id_barang]), 'method' => 'get', 'class' => 'form-inline', 'target'=>'_blank']) }}
                    {!! Form::button('<i class="fa fa-print"id="btnPopover1" title="Cetak Kartu Persediaan barang Per barang" data-toggle="tooltip"></i>', ['type'=>'submit','class'=>'btn btn-xs btn-fill btn-primary']) !!}
                    {{ Form::close() }}
                  </td>
                </tr>
              @endforeach
              </table>
          </div>
      </div>
    </div> 

  </div>
@endsection
@section('script')
<script type="text/javascript">

  $('#id_barang_search').select2({
          placeholder: 'Masukkan Nama Barang',
          minimumInputLength: 3,
          ajax: {
            url: '{{route('searchbarang_penjaga')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                      return {
                          text: item.nama_barang,
                          id:item.id+','+item.nama_barang+','+item.kode_barang                                                  
                      }                                                                
                  })
              };
            },
            cache: true
          }
        });

    $('#id_barang_search').change(function() {
      var kode_barang = this.value.split(",").pop();      
      var id_barang = this.value.split(",").shift();
      $('#id_barang').val(id_barang);         
    });    
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#btnPopover1').tooltip();  
  });
</script>

<script>
  $(function () {
    $('#dataTabelDataPersediaan').DataTable({"pageLength": 5, "scrollX": true});
  });
</script>
@endsection