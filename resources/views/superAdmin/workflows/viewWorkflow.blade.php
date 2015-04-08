@extends('superAdmin.master')

@section('content')
	<h2>
		{{ $workflowName }}
	</h2>
	<table class='table table-hover table-condensed'>
		<tr>
	@foreach ($fields as $field)
		<th>{{ $field->Field }}</th>
	@endforeach
		</tr>
		</tr>
			<td>
				{{ $entry->id }}
			</td>
			<td>
				{{ $entry->created_at }}
			</td>
			<td>
				{{ $entry->updated_at }}
			</td>
			<td>
				{{ $entry->default }}
			</td>
			<td>
				{{ $entry->workflowitem }}
			</td>
			<td>
				{{ $entry->originaldestination }}
			</td>
			<td>
				{{ $entry->finaldestination }}
			</td>
		</tr>
	</table>
@stop