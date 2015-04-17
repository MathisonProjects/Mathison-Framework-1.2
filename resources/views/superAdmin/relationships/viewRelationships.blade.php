@extends('superAdmin.master')

@section('content')
	<h2>Relationships</h2>
	<table class='table table-hover table-condensed'>
		<thead>
			<tr>
				<th style="width: 50px;text-align: center;">ID</th>
				<th style="text-align: center;">Name</th>
				<th style="text-align: center;">Type</th>
				<th style="text-align: center;">Table One</th>
				<th style="text-align: center;">Table Two</th>
				<th style="text-align: center;">Field One</th>
				<th style="text-align: center;">Field Two</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($menu['relationships'] as $item)
				<tr>
					<td style="text-align: center;">{{ $item->id }}</td>
					<td style="text-align: center;"><a href='/admin/super/viewRelationship/{{ $item->name }}'>{{ $item->id }}</a></td>
					<td style="text-align: center;">{{ $item->relationshiptype }}</td>
					<td style="text-align: center;">{{ $item->tableone }}</td>
					<td style="text-align: center;">{{ $item->tabletwo }}</td>
					<td style="text-align: center;">{{ $item->fieldone }}</td>
					<td style="text-align: center;">{{ $item->fieldtwo }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop