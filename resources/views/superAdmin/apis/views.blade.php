@extends('superAdmin.master')

@section('content')
	<h2>APIs</h2>
	<table class='table table-hover table-condensed'>
		<tr>
			<th style='width: 60px;text-align: center;'>View</th>
			<th style='width: 60px;text-align: center;'>Edit</th>
			<th style='width: 60px;text-align: center;'>Delete</th>
			<th style='width: 60px;text-align: center;'>Id</th>
			<th style='text-align: center;'>Random ID</th>
			<th style='text-align: center;'>Action</th>
			<th style='text-align: center;'>Name</th>
			<th style='text-align: center;'>Form Processing Id</th>
		</tr>
		@foreach ($apis as $api)
		<tr>
			<td style='text-align: center;'><a href='api/{{ $api->id }}'><i><span class='glyphicon glyphicon-eye-open'></span></i></a></td>
			<td style='text-align: center;'><a href='api/{{ $api->id }}/edit'><i><span class='glyphicon glyphicon-edit'></span></i></a></td>
			<td style='text-align: center;'><a href='api/{{ $api->id }}'><i><span class='glyphicon glyphicon-remove'></span></i></a></td>
			<td style='text-align: center;'>{{ $api->id }}</td>
			<td style='text-align: center;'>{{ $api->randomid }}</td>
			<td style='text-align: center;'>{{ $api->action }}</td>
			<td style='text-align: center;'>{{ $api->name }}</td>
			<td style='text-align: center;'>{{ $api->fid }}</td>
		</tr>
		@endforeach
	</table>
@stop