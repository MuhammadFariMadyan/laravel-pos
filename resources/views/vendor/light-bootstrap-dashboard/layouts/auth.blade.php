<!DOCTYPE html>
<html lang="@yield('lang', config('app.locale', 'en'))">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<title>Toko Aisyah</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="{{ asset('/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

  <!-- Styles -->
  @section('styles')
  <link href="{{ mix('/css/light-bootstrap-dashboard.css') }}" rel="stylesheet">
  <link href="{{ mix('/css/auth.css') }}" rel="stylesheet">
  @show
  @stack('head')
</head>
<body background="/images/bg-toko-aisyah.png">
  <div id="app" class="container">
		@yield('content')
	</div>

	@section('scripts')
	<script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ mix('/js/manifest.js') }}" charset="utf-8"></script>
	<script src="{{ mix('/js/vendor.js') }}" charset="utf-8"></script>
	<script src="{{ mix('/js/auth.js') }}" charset="utf-8"></script>
	<script src="{{ asset('/js/bootstrap-notify.min.js') }}"></script>
	@show
	@stack('body')
</body>
</html>
