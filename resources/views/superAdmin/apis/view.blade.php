@extends('superAdmin.master')

@section('content')
	<h2>API #{{ $api['id'] }}</h2>
	<table class='table table-hover table-condensed'>
		<tr>
			<th>ID</th>
			<td>{{ $api['id'] }}</td>
		</tr>
		<tr>
			<th>Random Id</th>
			<td>{{ $api['randomid'] }}</td>
		</tr>
		<tr>
			<th>Name</th>
			<td>{{ $api['name'] }}</td>
		</tr>
		<tr>
			<th>Action</th>
			<td>{{ $api['action'] }}</td>
		</tr>
		<tr>
			<th>Form Id</th>
			<td>{{ $api['fid'] }}</td>
		</tr>
		<tr>
			<th>Object ID</th>
			<td>{{ $api['oid'] }}</td>
		</tr>
	</table>
@stop