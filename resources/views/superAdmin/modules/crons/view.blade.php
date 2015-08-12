@extends('superAdmin.master')

@section('content')
	<h2>Cron #{{ $data['id'] }}</h2>
	<table class='table table-hover table-condensed'>
		<tr>
			<th>ID</th>
			<td>{{ $data['id'] }}</td>
		</tr>
		<tr>
			<td>name</td>
			<td>{{ $data['name'] }}</td>
		</tr>
		<tr>
			<td>description</td>
			<td>{{ $data['description'] }}</td>
		</tr>
		<tr>
			<td>active</td>
			<td>{{ $data['active'] }}</td>
		</tr>
		<tr>
			<td>oid</td>
			<td>{{ $data['oid'] }}</td>
		</tr>
		<tr>
			<td>fid</td>
			<td>{{ $data['fid'] }}</td>
		</tr>
		<tr>
			<td>modtype</td>
			<td>{{ $data['modtype'] }}</td>
		</tr>
		<tr>
			<td>modifier</td>
			<td>{{ $data['modifier'] }}</td>
		</tr>
		<tr>
			<td>frequency</td>
			<td>{{ $data['frequency'] }}</td>
		</tr>
		<tr>
			<td>lastran</td>
			<td>{{ $data['lastran'] }}</td>
		</td>
	</table>
@stop