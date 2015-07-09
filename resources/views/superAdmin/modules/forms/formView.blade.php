<h2>{{$formItem[0]['name']}}</h2>
<h3>{{$formItem[0]['description']}}</h3>
{!! Form::open(['url'=>'admin/super/formprocessing/']) !!}
{!! Form::hidden('apiId', $apiId) !!}
@foreach ($formItem[1] as $key => $item)
<div class='row'>
	<div class='col-md-12'>
		@if ($item['fieldtype'] != 'add_Submit')
		{!! Form::label($item['name'], ucfirst($item['name'])) !!}
		@endif
		@if ($item['fieldtype'] == 'add_Textbox')
		{!! Form::text($item['name'], null, ['class' => 'form-control', 'id' => $item['name']]) !!}
		@elseif ($item['fieldtype'] == 'add_Submit')
		{!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
		@endif
	</div>
</div>
@endforeach
{!! Form::close() !!}