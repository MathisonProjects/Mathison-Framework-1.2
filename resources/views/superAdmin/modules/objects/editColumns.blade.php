@extends('superAdmin.master')

@section('content')
	<h2>Edit Object Columns</h2>
	{!! Form::open() !!}
	<div class='row'>
		<div class='col-md-4'>
	@foreach ($object as $field)
		<div class='form-group'>
			{!! Form::label($field->id, 'Old Name: '.$field->name) !!}
			{!! Form::text($field->id, '', array('id' => $field->id, 'class' => 'form-control', 'placeholder' => $field->name)) !!}
		</div>
	@endforeach
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12']) !!}
		</div>
		</div>
	</div>
	{!! Form::close() !!}
@stop