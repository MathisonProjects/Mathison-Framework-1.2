@extends('superAdmin.master')

@section('content')
	<h1>{{ $objectName }}</h1>
	
	@foreach ($sharedData['primary'] as $data)
		@foreach ($data as $key => $units)
			@if ($key === 'object')
				<h3>{{ $units }}</h3>
			@elseif ($key !== 'object')
				@foreach ($units as $newKey => $unit)
					@foreach ($unit as $details => $dividedUnit)
						{{ $details }}
					@endforeach
				@endforeach
			@endif
		@endforeach
	@endforeach
@stop