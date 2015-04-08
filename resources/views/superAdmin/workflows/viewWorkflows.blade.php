@extends('superAdmin.master')

@section('content')
	<br />
	<table class='table table-hover table-condensed'>
		<tr>
			<th>Workflow Name</th>
			<th>Default</th>
			<th>Original Destination</th>
			<th>Final Destination</th>
		</tr>
	@foreach ($menu['workflows'] as $item)
		<tr>
			<td>{{ $item->workflowitem }}</td>
			<td>{{ $item->default }}</td>
			<td>{{ $item->originaldestination }}</td>
			<td>{{ $item->finaldestination }}</td>
	@endforeach
	</table>
@stop