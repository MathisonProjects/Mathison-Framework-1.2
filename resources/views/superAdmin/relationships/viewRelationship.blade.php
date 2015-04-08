@extends('superAdmin.master')

@section('content')
	<h2>{{ $relationshipName }}</h2>
	<table class='table table-hover table-condensed'>
		<thead>
			<tr>
				<th>Field</th>
				<th>Value</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Relationship Type</th>
				<td>{{ $relationship->relationshiptype }}</td>
			</tr>
			<tr>
				<th>Object One (From)</th>
				<td>{{ $relationship->tableone }}</td>
			</tr>
			<tr>
				<th>Object Two (To)</th>
				<td>{{ $relationship->tabletwo }}</td>
			</tr>
			<tr>
				<th>Field One (From)</th>
				<td>{{ $relationship->fieldone }}</td>
			</tr>
			<tr>
				<th>Field Two (To)</th>
				<td>{{ $relationship->fieldtwo }}</td>
			</tr>

		</tbody>
	</table>
@stop