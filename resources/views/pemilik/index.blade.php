@extends('layouts.app')

@section('content-title', 'Dashboard Pemilik Toko')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">Home</li>
  </ol>
@endsection

@section('content')
  <div class="row">

  </div>
@endsection


@section('script')
  @if (Session::get('berhasil_login'))
    <script type="text/javascript">
          $.notify({
          // options
          message: '<strong>Selamat Datang:</strong><br> Hallo, {{$user->name}}, gunakan sistem ini dengan baik..',
          },{
          // settings
          type: 'info',
          animate: {
            enter: 'animated fadeInRight',
            exit: 'animated fadeOutRight'
          },
          allow_dismiss: false
        },
      );
    </script>
  @endif


@endsection
