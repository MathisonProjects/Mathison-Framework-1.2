@extends('superAdmin.master')

@section('content')
	<h1>{{ $objectName }}</h1>
	
	
	@foreach ($sharedData['primary'] as $data)
		<h3>{{ $data['object'] }}</h3>
		@foreach ($data as $key => $units)
			@if ($key != 'object')
				$units->id;
			@endif
		@endforeach
	@endforeach
@stop