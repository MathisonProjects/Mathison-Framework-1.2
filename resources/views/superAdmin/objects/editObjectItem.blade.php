@extends('superAdmin.master')

@section('content')
	<h2>Edit {{ $objectName }}: ID# {{ $record->id }}</h2>

	
	{!! Form::open() !!}
	  {!! Form::hidden('objectName', $object->name) !!}
	  {!! Form::hidden('id', $record->id) !!}

	<table class='table table-hover table-condensed'>
		@foreach ($fields as $field)
			@if ($field->name != 'id')
			<tr>
				<th>{{ $field->name }}</th>
				<td>{!! Form::text($field->name, $record->{$field->name}, array('placeholder' => $field->name, 'class' => 'form-control', )) !!}</td>
			</tr>
			@endif
		@endforeach
	</table>
	<button type="submit" class="btn btn-primary">Save changes</button>
	{!! Form::close() !!}
@stop