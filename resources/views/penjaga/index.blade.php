@extends('layouts.app')

@section('content-title', 'Dashboard Penjaga Toko')


@section('content')
<div class="row">
</div>
@endsection


@section('script')
  @if (Session::get('berhasil_login'))
    <script type="text/javascript">
          $.notify({
          // options
          message: '<strong>Selamat Datang:</strong><br> Hallo, {{$user->name}}, silahkan gunakan sistem ini dengan baik..',
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
