@extends('layouts.app')

@section('content-title', 'Data Penjaga')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">Data Penjaga</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
                          <div class="card">
                              <div class="header">
                                  <h4 class="title">Data Penjaga<span class="pull-right"><a href={{route('tambahpenjaga')}} class="btn btn-xs btn-fill btn-info">Tambah Penjaga</a></span></h4>
                              </div>
                              <div class="content table-responsive table-full-width">
                                  {!! $html->table(['class'=>'table table-striped table-hover'])!!}
                              </div>
                          </div>
                      </div>
                    </div>
@endsection

@section('script')
  {!! $html->scripts() !!}
@endsection
