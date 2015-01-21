@extends('superAdmin.master')

@section('content')
	<br />
	<table class='table table-hover table-condensed'>
		<tr>
			<th>Object Name</th>
			<th>Description</th>
		</tr>
	@foreach ($menu['objects'] as $item)
		<tr>
			<td>{{ $item->name }}</td>
			<td>{{ $item->objectDescription }}</td>
	@endforeach
	</table>
@stop