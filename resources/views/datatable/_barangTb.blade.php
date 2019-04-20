{!! Form::model($model, ['url'=>$form_url, 'method'=>'delete','class'=>'form-inline']) !!}
<a href="{!! $edit_url !!}" class="btn btn-xs btn-success btn-fill"><i class="fa fa-edit" id="btnPopover1" title="Edit data ini" data-toggle="tooltip"></i></a>
{!! Form::button('<i class="fa fa-trash" id="btnPopover2" title="Tekan tombol ini jika anda mau menghapus data" data-toggle="tooltip"></i>', ['type'=>'submit','class'=>'btn btn-xs btn-fill btn-danger']) !!}
{!! Form::close() !!}
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $('#btnPopover1').tooltip();
    $('#btnPopover2').tooltip();
  });
</script>
@endsection