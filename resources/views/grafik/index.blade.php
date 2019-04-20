@extends('layouts.app')

@section('content-title', 'Grafik Penjualan')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">Grafik Penjualan</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
                          <div class="card">
                              <div class="header">
                                  <h4 class="title">Grafik Penjualan</h4>
                              </div>
                              <div class="content">
                                  <form class="form-inline" action="{{route('lihatgrafik')}}">
                                    <div class="form-group">
                                      <label for="">Tahun&nbsp;:&nbsp;</label>
                                      <input type="number" class="form-control input-sm" id="tahun" name="tahun" placeholder="Contoh: 2018">
                                    </div>&nbsp;
                                    <button type="submit" class="btn btn-success btn-fill btn-sm">Tampilkan</button>
                                  </form>

                                  {{-- {!! $html->table(['class'=>'table table-striped table-hover'])!!} --}}
                              </div>

                          </div>
                          {!! $chart->html() !!}                          
                      </div>
                    </div>
@endsection

@section('script')
{!! $chart->script() !!}
{{-- 
<script type="text/javascript">
var month = new Date();
var today = new Date();
month.setDate(month.getDate() - 30);
document.getElementById('tanggalawal').value =  month.toISOString().substr(0, 10);
document.getElementById('tanggalakhir').value =  today.toISOString().substr(0, 10);
</script> --}}
@endsection
