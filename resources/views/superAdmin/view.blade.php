@extends('superAdmin.master')

@section('content')
	<h2>
		{{ $objectName }}
	</h2>
	<h4>{{ $description }}</h4>
	
	<table class='table table-hover table-condensed'>
		<tr>
	@foreach ($fields as $field)
		<th>{{ $field->name }}</th>
	@endforeach
		</tr>
	</table>
@stop
