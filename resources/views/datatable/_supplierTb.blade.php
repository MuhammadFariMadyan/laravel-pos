{!! Form::model($model, ['url'=>$form_url, 'method'=>'delete','class'=>'form-inline']) !!}
<a href="{!! $edit_url !!}" class="btn btn-xs btn-success btn-fill"><i class="fa fa-edit"></i></a>
{!! Form::button('<i class="fa fa-trash"></i>', ['type'=>'submit','class'=>'btn btn-xs btn-fill btn-danger']) !!}
{!! Form::close() !!}
  
