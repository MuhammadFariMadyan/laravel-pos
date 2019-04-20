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
	<link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">
	{!! Charts::styles() !!}
  @show
  @stack('head')
</head>
<body>
	<div id="app" class="wrapper">
		@include('light-bootstrap-dashboard::layouts.sidebar.main')

		@include('light-bootstrap-dashboard::layouts.main-panel.main')
	</div>

	@section('scripts')
	<script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ mix('/js/manifest.js') }}" charset="utf-8"></script>
	<script src="{{ mix('/js/vendor.js') }}" charset="utf-8"></script>
	{!! Charts::scripts() !!}
	<script src="{{ mix('/js/light-bootstrap-dashboard.js') }}" charset="utf-8"></script>
	<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-notify.min.js') }}"></script>
	<script src="{{asset('/js/select2.full.min.js')}}"></script>

	@show
	@stack('body')

	@yield('script')
	@include('notify._notif')
</body>
</html>
