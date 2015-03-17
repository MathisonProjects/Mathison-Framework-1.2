@extends('superAdmin.master')

@section('content')
	<h1>{{ $objectName }}</h1>
	
	@foreach ($record as $data)
		<table class='table table-hover table-condensed'>
		<tr>
		@foreach ($data as $key => $recordInfo)
			<th>{{ $key }}</th>
		@endforeach
		</tr>
		<tr>
		@foreach ($data as $recordInfo)
			<td>{{ $recordInfo }}</td>
		@endforeach
		</tr>

		</table>
	@endforeach

	@foreach ($sharedData['primary'] as $key => $info)
		<h3>{{ $info['object'] }}s Primary Relationship</h3>
		<table class='table table-hover table-condensed'>
		@foreach ($info['data'] as $id => $data)
			@if ($id === 0)
				<tr>
				@foreach ($data as $key => $field)
					<th>{{ $key }}</th>
				@endforeach
				</tr>
			@endif
			<tr>
			@foreach ($data as $key => $field)
				<td>{{ $field }}</td>
			@endforeach
			</tr>
		@endforeach
		</table>
	@endforeach

	@foreach ($sharedData['secondary'] as $key => $info)
		<h3>{{ $info['object'] }}s Secondary Relationship</h3>
		<table class='table table-hover table-condensed'>
		@foreach ($info['data'] as $id => $data)
			@if ($id === 0)
				<tr>
				@foreach ($data as $key => $field)
					<th>{{ $key }}</th>
				@endforeach
				</tr>
			@endif
			<tr>
			@foreach ($data as $key => $field)
				<td>{{ $field }}</td>
			@endforeach
			</tr>
		@endforeach
		</table>
	@endforeach


@stop