<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laporan</title>
    <link href="{{ mix('/css/light-bootstrap-dashboard.css') }}" rel="stylesheet">
    <style type="text/css" media="print">
    @page {
        size: auto;   /* auto is the initial value */
        margin: 0;  /* this affects the margin in the printer settings */
    }
    </style>
  </head>
  <h1 class="text-center">TOKO AISYAH BABY AND KIDS</h1>
  <h3 class="text-center">SIMPUR CENTER BANDAR LAMPUNG</h3>
  <hr>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center text-uppercase">@yield('judul')</h2>
        @yield('print')
      </div>
    </div>
  </div>
  <hr>
      <center>&copy;2017 TOKO AISYAH BABY & KIDS</center>
  </body>
  <script>
  window.print();
  var today = new Date();
  document.getElementById('tanggal').innerHTML = " : "+ today.toISOString().substr(0, 10);
  </script>
</html>
