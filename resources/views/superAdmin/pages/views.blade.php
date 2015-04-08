@extends('superAdmin.master')

@section('content')
	<h2>Pages</h2>
	<table class='table table-hover table-condensed'>
		<tr>
			<th style="width: 60px;text-align: center;">View</th>
			<th style="width: 60px;text-align: center;">Edit</th>
			<th style="width: 60px;text-align: center;">Delete</th>
			<th style="width: 60px;text-align: center;">ID</th>
			<th style="width: 60px;text-align: center;">String URL</th>
			<th style="width: 60px;text-align: center;">Template ID</th>
		</tr>
		@foreach ($menu['pages'] as $item)
		<tr>
			<td style='text-align: center;'><a href='pages/{{ $item->id }}'><i><span class='glyphicon glyphicon-eye-open'></span></i></a></td>
			<td style='text-align: center;'><a href='pages/{{ $item->id }}/edit'><i><span class='glyphicon glyphicon-edit'></span></i></a></td>
			<td style='text-align: center;'><a href='pages/{{ $item->id }}'><i><span class='glyphicon glyphicon-remove'></span></i></a></td>
			<td>{{ $item->id }}</td>
			<td>{{ $item->stringurl }}</td>
			<td>{{ $item->tid }}</td>
		</tr>
		@endforeach
	</table>
@stop