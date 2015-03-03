@extends('superAdmin.master')

@section('content')
	<h2>View Objects</h2>
	<table class='table table-hover table-condensed'>
		<tr>
			<th>Object Name</th>
			<th>Description</th>
		</tr>
	@foreach ($menu['objects'] as $item)
		<tr>
			<td><a href='/admin/super/viewObject/{{ $item->name }}'>{{ $item->name }}</a></td>
			<td>{{ $item->objectDescription }}</td>
	@endforeach
	</table>
@stop