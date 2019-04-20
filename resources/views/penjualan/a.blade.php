<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  </head>
  <body>

<div class="container">

  <h2>Laravel 5 - Dynamic autocomplete search using select2 JS Ajax</h2>
  <br/>
  <select class="itemName form-control" style="width:500px;" name="itemName"></select>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
      $('.itemName').select2({
        placeholder: 'Select an item',
        ajax: {
          url: '{{route('searchbarang')}}',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.nama_barang,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
      });

</script>
  </body>
</html>
